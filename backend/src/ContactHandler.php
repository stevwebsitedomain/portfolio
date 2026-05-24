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

            http_response_code(500);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'ok' => false,
                'success' => false,
                'error' => $e->getMessage(),
                'message' => $e->getMessage(),
                'httpCode' => 500,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
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
            $httpCode = $this->mailer->getLastHttpCode();
            $brevoResponse = $this->mailer->getLastResponseBody();
            $errorMessage = $this->mailer->getLastError();

            http_response_code($httpCode > 0 ? $httpCode : 500);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'ok' => false,
                'success' => false,
                'error' => $brevoResponse !== '' ? $brevoResponse : $errorMessage,
                'message' => $errorMessage,
                'httpCode' => $httpCode,
                'brevoResponse' => $brevoResponse,
                'senderEmail' => (string) ($this->config['senderEmail'] ?? ''),
                'hint' => 'If sender is not verified in Brevo, verify SENDER_EMAIL under Brevo → Senders.',
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            return;
        }

        JsonResponse::send(200, [
            'ok' => true,
            'success' => true,
            'message' => 'Your message has been sent. Thank you!',
        ]);
    }
}
