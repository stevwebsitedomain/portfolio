<?php

declare(strict_types=1);

namespace Portfolio\Api;

use PHPMailer\PHPMailer\Exception as MailerException;
use PHPMailer\PHPMailer\PHPMailer;

final class Mailer
{
    private string $lastError = '';

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(private readonly array $config)
    {
    }

    public function isConfigured(): bool
    {
        return Env::getGmailAppPassword() !== '';
    }

    public function getTransport(): string
    {
        return $this->isConfigured() ? 'smtp' : 'none';
    }

    public function isReadyForCurrentHost(): bool
    {
        return $this->isConfigured();
    }

    public function getLastError(): string
    {
        return $this->lastError;
    }

    /**
     * @return array<string, mixed>
     */
    public function getDiagnostics(): array
    {
        return [
            'mailTransport' => $this->getTransport(),
            'mailReady' => $this->isReadyForCurrentHost(),
            'mailConfigured' => $this->isConfigured(),
            'senderEmail' => (string) ($this->config['senderEmail'] ?? ''),
            'contactRecipientEmail' => (string) ($this->config['contactRecipientEmail'] ?? ''),
            'smtpHost' => (string) ($this->config['smtpHost'] ?? 'smtp.gmail.com'),
            'smtpPort' => (int) ($this->config['smtpPort'] ?? 587),
            'gmailPasswordConfigured' => Env::getGmailAppPassword() !== '',
        ];
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    public function send(array $message): bool
    {
        $this->lastError = '';

        $password = Env::getGmailAppPassword();
        if ($password === '') {
            $this->lastError = 'GMAIL_APP_PASSWORD is not set on the server.';

            return false;
        }

        $fromEmail = (string) ($this->config['senderEmail'] ?? 'developer.company2026@gmail.com');
        $fromName = (string) ($this->config['senderName'] ?? 'Steven Portfolio');
        $smtpUser = (string) ($this->config['smtpUser'] ?? $fromEmail);
        $smtpHost = (string) ($this->config['smtpHost'] ?? 'smtp.gmail.com');
        $portsToTry = [
            [
                'port' => 587,
                'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
                'label' => '587/TLS',
            ],
            [
                'port' => 465,
                'encryption' => PHPMailer::ENCRYPTION_SMTPS,
                'label' => '465/SSL',
            ],
        ];

        $attemptErrors = [];

        foreach ($portsToTry as $attempt) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = $smtpHost;
                $mail->SMTPAuth = true;
                $mail->Username = $smtpUser;
                $mail->Password = $password;
                $mail->SMTPSecure = $attempt['encryption'];
                $mail->Port = $attempt['port'];
                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                $mail->Timeout = 60;

                $mail->setFrom($fromEmail, $fromName);
                $mail->addAddress($message['to']);
                $mail->addReplyTo($message['replyEmail'], $message['replyName']);
                $mail->Subject = $message['subject'];
                $mail->Body = $message['body'];
                $mail->isHTML(false);

                $mail->send();

                return true;
            } catch (MailerException $e) {
                $error = $mail->ErrorInfo !== '' ? $mail->ErrorInfo : $e->getMessage();
                $attemptErrors[] = $attempt['label'] . ': ' . $error;
                error_log('[Portfolio Mailer] Gmail SMTP ' . $attempt['label'] . ' failed: ' . $error);
            }
        }

        $this->lastError = 'Gmail SMTP failed on 587/TLS and 465/SSL. '
            . implode(' | ', $attemptErrors)
            . ' If both ports time out on Render, Render is likely blocking outbound Gmail SMTP.';
        error_log('[Portfolio Mailer] ' . $this->lastError);

        return false;
    }
}
