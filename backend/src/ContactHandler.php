<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class ContactHandler
{
    /**
     * @param array<string, mixed> $config
     */
    public function __construct(
        private readonly array $config,
        private readonly Mailer $mailer,
    ) {
    }

    public function handle(): void
    {
        try {
            $this->process();
        } catch (\Throwable $e) {
            error_log('[Portfolio Contact] ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());

            $payload = $this->mailer->getDiagnostics();
            if ($this->isDebugRequest()) {
                $payload['debug'] = $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine();
            }

            JsonResponse::error(500, 'Server error while sending message.', $payload);
        }
    }

    private function process(): void
    {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true);
        if (!is_array($data)) {
            JsonResponse::error(422, 'Invalid JSON body.');
            return;
        }

        $name = trim((string) ($data['name'] ?? ''));
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));
        $subject = trim((string) ($data['subject'] ?? ''));
        $message = trim((string) ($data['message'] ?? ''));

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            JsonResponse::error(422, 'Please fill in all fields.');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            JsonResponse::error(422, 'Please enter a valid email address.');
            return;
        }

        if (mb_strlen($subject) > 200 || mb_strlen($message) > 5000) {
            JsonResponse::error(422, 'Message is too long.');
            return;
        }

        if (!$this->mailer->isReadyForCurrentHost()) {
            JsonResponse::error(
                503,
                'BREVO_API_KEY is not set on Render. Gmail SMTP is blocked on Render free tier.',
                array_merge($this->mailer->getDiagnostics(), [
                    'hint' => 'Create free account at brevo.com → verify sender email → add BREVO_API_KEY on Render → redeploy.',
                ]),
            );
            return;
        }

        $to = (string) ($this->config['contactRecipientEmail'] ?? 'developer.company2026@gmail.com');
        $body = "Portfolio contact form\n\n"
            . "Name: {$name}\n"
            . "Email: {$email}\n"
            . "Subject: {$subject}\n\n"
            . "Message:\n{$message}\n";

        $sent = $this->mailer->send([
            'to' => $to,
            'replyEmail' => $email,
            'replyName' => $name,
            'subject' => '[Portfolio] ' . $subject,
            'body' => $body,
        ]);

        if (!$sent) {
            $detail = $this->mailer->getLastError();
            $error = $this->mapMailError($detail);

            $payload = array_merge($this->mailer->getDiagnostics(), [
                'hint' => $this->hintForMailError($detail),
            ]);
            if ($this->isDebugRequest()) {
                $payload['debug'] = $detail !== '' ? $detail : 'Mail send returned false with no detail.';
            }

            JsonResponse::error(500, $error, $payload);
            return;
        }

        JsonResponse::send(200, [
            'ok' => true,
            'success' => true,
            'message' => 'Your message has been sent. Thank you!',
        ]);
    }

    private function mapMailError(string $detail): string
    {
        if ($detail === '') {
            return 'Could not send your message right now. Please try again later or email us directly.';
        }

        if (str_contains($detail, 'authenticate') || str_contains($detail, 'Authentication')) {
            return 'Email server login failed. Check Gmail App Password on Render (SMTP_PASSWORD).';
        }

        if (str_contains($detail, 'Could not connect to SMTP host') || str_contains($detail, 'Failed to connect')) {
            return 'Render blocks Gmail SMTP. Add BREVO_API_KEY on Render (free at brevo.com).';
        }

        if (str_contains($detail, 'timed out') || str_contains($detail, 'Timeout')) {
            return 'Email server timeout. On Render use BREVO_API_KEY instead of Gmail SMTP.';
        }

        if (str_contains($detail, 'API key') || str_contains($detail, 'unauthorized')) {
            return 'Invalid BREVO_API_KEY on Render. Check the key and redeploy.';
        }

        return $detail;
    }

    private function hintForMailError(string $detail): string
    {
        if (str_contains($detail, 'Could not connect to SMTP host') || str_contains($detail, 'Failed to connect')) {
            return 'Set BREVO_API_KEY on Render Environment Variables, then redeploy.';
        }

        if (str_contains($detail, 'sender') || str_contains($detail, 'Sender')) {
            return 'Verify sender email in Brevo dashboard (Senders → verify developer.company2026@gmail.com).';
        }

        return 'Check Render logs and BREVO_API_KEY. Test GET /api/contact for diagnostics.';
    }

    private function isDebugRequest(): bool
    {
        if (getenv('MAIL_DEBUG') === '1' || getenv('MAIL_DEBUG') === 'true') {
            return true;
        }

        $header = $_SERVER['HTTP_X_PORTFOLIO_DEBUG'] ?? '';

        return $header === '1' || strtolower($header) === 'true';
    }
}
