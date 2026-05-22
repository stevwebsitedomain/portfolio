<?php

declare(strict_types=1);

namespace Portfolio\Api;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailerException;

final class Mailer
{
    /**
     * @param array<string, mixed> $config
     */
    public function __construct(private readonly array $config)
    {
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    public function send(array $message): bool
    {
        $dsn = (string) ($this->config['mailerDsn'] ?? '');
        if ($dsn === '') {
            return false;
        }

        $smtp = $this->parseDsn($dsn);
        if ($smtp === null) {
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

            $fromEmail = (string) ($this->config['senderEmail'] ?? $smtp['user']);
            $fromName = (string) ($this->config['senderName'] ?? 'Portfolio');

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($message['to']);
            $mail->addReplyTo($message['replyEmail'], $message['replyName']);
            $mail->Subject = $message['subject'];
            $mail->Body = $message['body'];
            $mail->isHTML(false);

            return $mail->send();
        } catch (MailerException) {
            return false;
        }
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
        $host = (string) ($parts['host'] ?? '');

        if ($host === '' || $host === 'default') {
            $host = 'smtp.gmail.com';
        }

        $port = (int) ($parts['port'] ?? 587);
        $encryption = PHPMailer::ENCRYPTION_STARTTLS;

        return [
            'host' => $host,
            'port' => $port,
            'user' => $user,
            'pass' => $pass,
            'encryption' => $encryption,
        ];
    }
}
