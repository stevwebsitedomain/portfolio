<?php

declare(strict_types=1);

namespace Portfolio\Api;

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
        return Env::getBrevoApiKey() !== '';
    }

    public function getTransport(): string
    {
        return $this->isConfigured() ? 'brevo' : 'none';
    }

    public function getLastError(): string
    {
        return $this->lastError;
    }

    public static function isRenderHost(): bool
    {
        return getenv('RENDER') === 'true'
            || getenv('RENDER_SERVICE_ID') !== false
            || getenv('RENDER_SERVICE_NAME') !== false;
    }

    public function isReadyForCurrentHost(): bool
    {
        return Env::getBrevoApiKey() !== '';
    }

    /**
     * @return array<string, mixed>
     */
    public function getDiagnostics(): array
    {
        return [
            'mailTransport' => $this->getTransport(),
            'mailReady' => $this->isReadyForCurrentHost(),
            'onRender' => self::isRenderHost(),
            'brevoConfigured' => Env::getBrevoApiKey() !== '',
        ];
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    public function send(array $message, string $brevoApiKey): bool
    {
        $this->lastError = '';
        $apiKey = trim($brevoApiKey);

        if ($apiKey === '') {
            return $this->fail('BREVO_API_KEY is missing');
        }

        if (str_starts_with($apiKey, 'xsmtpsib-')) {
            return $this->fail(
                'Wrong Brevo key: xsmtpsib- is SMTP only. Use API key (xkeysib-) from Brevo → API keys.',
            );
        }

        if (!str_starts_with($apiKey, 'xkeysib-')) {
            return $this->fail('BREVO_API_KEY must start with xkeysib- (Brevo API key).');
        }

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
