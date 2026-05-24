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
        return $this->getTransport() !== 'none';
    }

    public function getTransport(): string
    {
        $forced = strtolower(trim((string) ($this->config['mailTransport'] ?? '')));
        if ($forced === 'brevo' && $this->hasBrevo()) {
            return 'brevo';
        }
        if ($forced === 'resend' && $this->hasResend()) {
            return 'resend';
        }
        if ($forced === 'smtp' && $this->resolveSmtp() !== null) {
            return 'smtp';
        }
        if ($forced !== '' && $forced !== 'auto') {
            return 'none';
        }

        if ($this->hasBrevo()) {
            return 'brevo';
        }
        if ($this->hasResend()) {
            return 'resend';
        }
        if ($this->resolveSmtp() !== null) {
            return 'smtp';
        }

        return 'none';
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

        return match ($this->getTransport()) {
            'brevo' => $this->sendViaBrevo($message),
            'resend' => $this->sendViaResend($message),
            'smtp' => $this->sendViaSmtp($message),
            default => $this->fail('Email not configured. Set BREVO_API_KEY on Render (see backend README).'),
        };
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    private function sendViaBrevo(array $message): bool
    {
        $apiKey = trim((string) ($this->config['brevoApiKey'] ?? ''));
        $fromEmail = (string) ($this->config['senderEmail'] ?? '');
        $fromName = (string) ($this->config['senderName'] ?? 'Portfolio');

        $result = $this->httpPostJson(
            'https://api.brevo.com/v3/smtp/email',
            [
                'api-key: ' . $apiKey,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            [
                'sender' => ['name' => $fromName, 'email' => $fromEmail],
                'to' => [['email' => $message['to']]],
                'replyTo' => ['email' => $message['replyEmail'], 'name' => $message['replyName']],
                'subject' => $message['subject'],
                'textContent' => $message['body'],
            ],
        );

        if ($result['status'] >= 200 && $result['status'] < 300) {
            return true;
        }

        $detail = is_array($result['json']) ? (string) ($result['json']['message'] ?? '') : '';
        if ($detail === '') {
            $detail = trim($result['body']);
        }

        return $this->fail($detail !== '' ? $detail : 'Brevo API request failed (HTTP ' . $result['status'] . ').');
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    private function sendViaResend(array $message): bool
    {
        $apiKey = trim((string) ($this->config['resendApiKey'] ?? ''));
        $fromEmail = (string) ($this->config['senderEmail'] ?? 'onboarding@resend.dev');
        $fromName = (string) ($this->config['senderName'] ?? 'Portfolio');

        $result = $this->httpPostJson(
            'https://api.resend.com/emails',
            [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            [
                'from' => $fromName . ' <' . $fromEmail . '>',
                'to' => [$message['to']],
                'reply_to' => $message['replyEmail'],
                'subject' => $message['subject'],
                'text' => $message['body'],
            ],
        );

        if ($result['status'] >= 200 && $result['status'] < 300) {
            return true;
        }

        $detail = is_array($result['json']) ? (string) ($result['json']['message'] ?? '') : '';
        if ($detail === '') {
            $detail = trim($result['body']);
        }

        return $this->fail($detail !== '' ? $detail : 'Resend API request failed (HTTP ' . $result['status'] . ').');
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    private function sendViaSmtp(array $message): bool
    {
        $smtp = $this->resolveSmtp();
        if ($smtp === null) {
            return $this->fail('SMTP not configured (set SMTP_PASSWORD or MAILER_DSN).');
        }

        $mail = new PHPMailer(true);
        try {
            return $this->attemptSend($mail, $smtp, $message);
        } catch (MailerException $e) {
            if ($smtp['port'] === 587 && $smtp['host'] === 'smtp.gmail.com') {
                try {
                    $smtp465 = $smtp;
                    $smtp465['port'] = 465;
                    $smtp465['encryption'] = PHPMailer::ENCRYPTION_SMTPS;
                    $mail = new PHPMailer(true);

                    return $this->attemptSend($mail, $smtp465, $message);
                } catch (MailerException $retry) {
                    return $this->fail($retry->getMessage());
                }
            }

            return $this->fail($e->getMessage());
        }
    }

    /**
     * @param array{host:string,port:int,user:string,pass:string,encryption:string} $smtp
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    private function attemptSend(PHPMailer $mail, array $smtp, array $message): bool
    {
        $mail->isSMTP();
        $mail->Host = $smtp['host'];
        $mail->Port = $smtp['port'];
        $mail->SMTPAuth = true;
        $mail->Username = $smtp['user'];
        $mail->Password = $smtp['pass'];
        $mail->SMTPSecure = $smtp['encryption'];
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->Timeout = 12;
        $mail->SMTPKeepAlive = false;
        $mail->SMTPAutoTLS = true;

        $fromEmail = (string) ($this->config['senderEmail'] ?? $smtp['user']);
        $fromName = (string) ($this->config['senderName'] ?? 'Portfolio');

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($message['to']);
        $mail->addReplyTo($message['replyEmail'], $message['replyName']);
        $mail->Subject = $message['subject'];
        $mail->Body = $message['body'];
        $mail->isHTML(false);

        return $mail->send();
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

    private function hasBrevo(): bool
    {
        return trim((string) ($this->config['brevoApiKey'] ?? '')) !== '';
    }

    private function hasResend(): bool
    {
        return trim((string) ($this->config['resendApiKey'] ?? '')) !== '';
    }

  /**
     * @param array<int, string> $headers
     * @param array<string, mixed> $body
     * @return array{status:int,body:string,json:mixed}
     */
    private function httpPostJson(string $url, array $headers, array $body): array
    {
        $headerStr = implode("\r\n", $headers) . "\r\n";
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headerStr,
                'content' => json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'timeout' => 20,
                'ignore_errors' => true,
            ],
        ]);

        $raw = @file_get_contents($url, false, $context);
        $status = 0;
        if (isset($http_response_header[0])) {
            preg_match('/\d{3}/', (string) $http_response_header[0], $matches);
            $status = (int) ($matches[0] ?? 0);
        }

        return [
            'status' => $status,
            'body' => is_string($raw) ? $raw : '',
            'json' => json_decode(is_string($raw) ? $raw : '[]', true),
        ];
    }

    private function fail(string $message): bool
    {
        $this->lastError = $message;
        error_log('[Portfolio Mailer] ' . $message);

        return false;
    }
}
