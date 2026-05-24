<?php

declare(strict_types=1);

namespace Portfolio\Api;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailerException;

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
        return $this->resolveSmtp() !== null;
    }

    public function getLastError(): string
    {
        return $this->lastError;
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    public function send(array $message): bool
    {
        $this->lastError = '';

        $smtp = $this->resolveSmtp();
        if ($smtp === null) {
            $this->lastError = 'SMTP not configured (set SMTP_PASSWORD or MAILER_DSN on Render).';
            return false;
        }

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $smtp['host'];
            $mail->Port = $smtp['port'];
            $mail->SMTPAuth = true;
            $mail->Username = $smtp['user'];
            $mail->Password = $smtp['pass'];
            $mail->SMTPSecure = $smtp['encryption'];
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Timeout = 30;
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                    'allow_self_signed' => false,
                ],
            ];

            $fromEmail = (string) ($this->config['senderEmail'] ?? $smtp['user']);
            $fromName = (string) ($this->config['senderName'] ?? 'Portfolio');

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($message['to']);
            $mail->addReplyTo($message['replyEmail'], $message['replyName']);
            $mail->Subject = $message['subject'];
            $mail->Body = $message['body'];
            $mail->isHTML(false);

            return $mail->send();
        } catch (MailerException $e) {
            $this->lastError = $e->getMessage();
            error_log('[Portfolio Mailer] ' . $e->getMessage());

            return false;
        }
    }

    /**
     * @return array{host:string,port:int,user:string,pass:string,encryption:string}|null
     */
    private function resolveSmtp(): ?array
    {
        $smtp = $this->config['smtp'] ?? [];
        if (is_array($smtp) && ($smtp['pass'] ?? '') !== '' && ($smtp['user'] ?? '') !== '') {
            $encryption = strtolower((string) ($smtp['encryption'] ?? 'tls'));
            $secure = $encryption === 'ssl'
                ? PHPMailer::ENCRYPTION_SMTPS
                : PHPMailer::ENCRYPTION_STARTTLS;

            return [
                'host' => (string) ($smtp['host'] ?: 'smtp.gmail.com'),
                'port' => (int) ($smtp['port'] ?: 587),
                'user' => (string) $smtp['user'],
                'pass' => (string) $smtp['pass'],
                'encryption' => $secure,
            ];
        }

        $dsn = (string) ($this->config['mailerDsn'] ?? '');
        if ($dsn !== '') {
            return $this->parseDsn($dsn);
        }

        return null;
    }

    /**
     * @return array{host:string,port:int,user:string,pass:string,encryption:string}|null
     */
    private function parseDsn(string $dsn): ?array
    {
        $parts = parse_url($dsn);
        if ($parts === false || ($parts['scheme'] ?? '') !== 'smtp') {
            return null;
        }

        $user = rawurldecode((string) ($parts['user'] ?? ''));
        $pass = rawurldecode((string) ($parts['pass'] ?? ''));
        if ($user === '' || $pass === '') {
            return null;
        }

        $host = (string) ($parts['host'] ?? '');
        if ($host === '' || $host === 'default') {
            $host = 'smtp.gmail.com';
        }

        $port = (int) ($parts['port'] ?? 587);

        return [
            'host' => $host,
            'port' => $port,
            'user' => $user,
            'pass' => $pass,
            'encryption' => $port === 465
                ? PHPMailer::ENCRYPTION_SMTPS
                : PHPMailer::ENCRYPTION_STARTTLS,
        ];
    }
}
