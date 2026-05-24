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

        if (!$this->mailer->isConfigured()) {
            http_response_code(503);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'ok' => false,
                'success' => false,
                'message' => 'GMAIL_APP_PASSWORD is missing on Render',
                'error' => 'GMAIL_APP_PASSWORD is missing on Render',
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
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
            $errorInfo = $this->mailer->getLastError();
            error_log('[Portfolio Contact] ' . $errorInfo);

            http_response_code(500);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'ok' => false,
                'success' => false,
                'message' => $errorInfo,
                'error' => $errorInfo,
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
