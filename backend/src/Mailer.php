<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Mailer
{
    private string $lastError = '';

    private int $lastHttpCode = 0;

    private string $lastResponseBody = '';

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

    public function getLastHttpCode(): int
    {
        return $this->lastHttpCode;
    }

    public function getLastResponseBody(): string
    {
        return $this->lastResponseBody;
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
            'senderEmail' => (string) ($this->config['senderEmail'] ?? ''),
        ];
    }

    /**
     * @param array{to:string,replyEmail:string,replyName:string,subject:string,body:string} $message
     */
    public function send(array $message, string $brevoApiKey): bool
    {
        $this->lastError = '';
        $this->lastHttpCode = 0;
        $this->lastResponseBody = '';

        $apiKey = trim($brevoApiKey);
        if ($apiKey === '') {
            return $this->fail('BREVO_API_KEY is missing', 0, '');
        }

        $fromEmail = trim((string) ($this->config['senderEmail'] ?? ''));
        $fromName = trim((string) ($this->config['senderName'] ?? 'Portfolio'));

        if ($fromEmail === '' || !filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->fail('SENDER_EMAIL is missing or invalid on Render.', 0, '');
        }

        $payload = [
            'sender' => ['name' => $fromName, 'email' => $fromEmail],
            'to' => [['email' => $message['to']]],
            'replyTo' => ['email' => $message['replyEmail'], 'name' => $message['replyName']],
            'subject' => $message['subject'],
            'textContent' => $message['body'],
        ];

        $jsonBody = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($jsonBody === false) {
            return $this->fail('Failed to encode email payload.', 0, '');
        }

        if (!function_exists('curl_init')) {
            return $this->fail('PHP cURL extension is not available on the server.', 0, '');
        }

        try {
            $ch = curl_init('https://api.brevo.com/v3/smtp/email');
            if ($ch === false) {
                return $this->fail('Could not initialize cURL.', 0, '');
            }

            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 25,
                CURLOPT_HTTPHEADER => [
                    'api-key: ' . $apiKey,
                    'Content-Type: application/json',
                    'Accept: application/json',
                ],
                CURLOPT_POSTFIELDS => $jsonBody,
            ]);

            $response = curl_exec($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            $this->lastHttpCode = $httpCode;
            $this->lastResponseBody = is_string($response) ? $response : '';

            error_log('[Portfolio Mailer] Brevo request sender=' . $fromEmail . ' to=' . $message['to']);
            error_log('[Portfolio Mailer] Brevo HTTP Code: ' . $httpCode);
            error_log('[Portfolio Mailer] Brevo response: ' . $this->lastResponseBody);

            if ($response === false) {
                return $this->fail('Brevo cURL error: ' . $curlError, $httpCode, $this->lastResponseBody);
            }

            if ($httpCode >= 200 && $httpCode < 300) {
                return true;
            }

            $parsed = json_decode($this->lastResponseBody, true);
            $detail = is_array($parsed)
                ? (string) ($parsed['message'] ?? $parsed['code'] ?? $this->lastResponseBody)
                : $this->lastResponseBody;

            return $this->fail($detail !== '' ? $detail : 'Brevo API error', $httpCode, $this->lastResponseBody);
        } catch (\Throwable $e) {
            error_log('[Portfolio Mailer] Exception: ' . $e->getMessage());

            return $this->fail($e->getMessage(), $this->lastHttpCode, $this->lastResponseBody);
        }
    }

    private function fail(string $message, int $httpCode, string $responseBody): bool
    {
        $this->lastError = $message;
        $this->lastHttpCode = $httpCode;
        if ($responseBody !== '') {
            $this->lastResponseBody = $responseBody;
        }

        error_log('[Portfolio Mailer] ' . $message);

        return false;
    }
}
