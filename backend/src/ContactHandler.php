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
            JsonResponse::send(422, ['ok' => false, 'error' => 'Invalid JSON body.']);
            return;
        }

        $name = trim((string) ($data['name'] ?? ''));
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));
        $subject = trim((string) ($data['subject'] ?? ''));
        $message = trim((string) ($data['message'] ?? ''));

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            JsonResponse::send(422, ['ok' => false, 'error' => 'Please fill in all fields.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            JsonResponse::send(422, ['ok' => false, 'error' => 'Please enter a valid email address.']);
            return;
        }

        if (mb_strlen($subject) > 200 || mb_strlen($message) > 5000) {
            JsonResponse::send(422, ['ok' => false, 'error' => 'Message is too long.']);
            return;
        }

        $to = (string) ($this->config['contactRecipientEmail'] ?? 'developer.company2026@gmail.com');
        $body = "Portfolio contact form\n\n"
            . "Name: {$name}\n"
            . "Email: {$email}\n"
            . "Subject: {$subject}\n\n"
            . "Message:\n{$message}\n";

        if (!$this->mailer->isConfigured()) {
            JsonResponse::send(503, [
                'ok' => false,
                'error' => 'Email service is not configured on the server. Please contact the site owner.',
            ]);
            return;
        }

        $sent = $this->mailer->send([
            'to' => $to,
            'replyEmail' => $email,
            'replyName' => $name,
            'subject' => '[Portfolio] ' . $subject,
            'body' => $body,
        ]);

        if (!$sent) {
            JsonResponse::send(500, [
                'ok' => false,
                'error' => 'Could not send your message right now. Please try again later or email us directly.',
            ]);
            return;
        }

        JsonResponse::send(200, ['ok' => true, 'message' => 'Your message has been sent. Thank you!']);
    }
}
