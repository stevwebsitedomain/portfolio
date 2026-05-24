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
        $brevoApiKey = '';

        if (isset($_ENV['BREVO_API_KEY'])) {
            $brevoApiKey = $_ENV['BREVO_API_KEY'];
        }

        if (!$brevoApiKey && getenv('BREVO_API_KEY')) {
            $brevoApiKey = getenv('BREVO_API_KEY');
        }

        if (!$brevoApiKey && isset($_SERVER['BREVO_API_KEY'])) {
            $brevoApiKey = $_SERVER['BREVO_API_KEY'];
        }

        if (empty(trim((string) $brevoApiKey))) {
            http_response_code(503);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'ok' => false,
                'success' => false,
                'message' => 'BREVO_API_KEY is missing',
                'error' => 'BREVO_API_KEY is missing',
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            exit;
        }

        $brevoApiKey = trim((string) $brevoApiKey);

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
        ], $brevoApiKey);

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

        if (
            str_contains($detail, 'Key not found')
            || str_contains($detail, 'API key')
            || str_contains($detail, 'unauthorized')
        ) {
            return 'Invalid BREVO_API_KEY. Use xkeysib- API key from Brevo → API keys (not xsmtpsib- SMTP key).';
        }

        if (str_contains($detail, 'sender') || str_contains($detail, 'Sender')) {
            return 'Sender email not verified in Brevo. Verify developer.company2026@gmail.com under Senders.';
        }

        return $detail;
    }

    private function hintForMailError(string $detail): string
    {
        if (str_contains($detail, 'Key not found') || str_contains($detail, 'API key')) {
            return 'Regenerate BREVO_API_KEY in Brevo (must start with xkeysib-). Paste on Render and redeploy.';
        }

        if (str_contains($detail, 'sender') || str_contains($detail, 'Sender')) {
            return 'Verify sender email in Brevo dashboard (Senders → verify developer.company2026@gmail.com).';
        }

        return 'Check Render logs. Test GET /api/contact for diagnostics.';
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
