<?php

declare(strict_types=1);

namespace App\Backend\Contact;

/**
 * SMS via messaging.kilakona.co.tz vendor API.
 */
final class KilakonaClient
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiSecret,
        private readonly string $senderId = 'TAARIFA',
        private readonly string $deliveryReportUrl = '',
        private readonly string $baseUrl = 'https://messaging.kilakona.co.tz/api/v1',
    ) {}

    /**
     * @return array{ok:bool,error:string}
     */
    public function sendSms(string $to, string $message): array
    {
        $payload = [
            'senderId' => $this->senderId,
            'messageType' => 'text',
            'message' => $message,
            'contacts' => $to,
        ];
        if ($this->deliveryReportUrl !== '') {
            $payload['deliveryReportUrl'] = $this->deliveryReportUrl;
        }

        $ch = curl_init(rtrim($this->baseUrl, '/') . '/vendor/message/send');
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'api_key: ' . $this->apiKey,
                'api_secret: ' . $this->apiSecret,
            ],
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            CURLOPT_TIMEOUT => 25,
            CURLOPT_CONNECTTIMEOUT => 12,
        ]);
        $raw = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($raw === false) {
            return ['ok' => false, 'error' => $curlErr !== '' ? $curlErr : 'Network error'];
        }

        $body = json_decode((string) $raw, true);
        if (!is_array($body)) {
            $body = [];
        }

        $apiError = '';
        foreach (['error', 'msg', 'detail', 'message'] as $key) {
            if ($status >= 400 && !empty($body[$key]) && is_string($body[$key])) {
                $apiError = $body[$key];
                break;
            }
        }

        $ok = $status >= 200
            && $status < 300
            && $apiError === ''
            && ($body['status'] ?? 'success') !== false
            && ($body['ok'] ?? true) !== false
            && ($body['success'] ?? true) !== false;

        if ($ok) {
            return ['ok' => true, 'error' => ''];
        }

        if ($status === 401 || stripos($apiError, 'unauthorized') !== false || stripos($apiError, 'api') !== false) {
            $apiError = $apiError !== '' ? $apiError : 'Kilakona rejected the API key or secret.';
        }

        return ['ok' => false, 'error' => $apiError !== '' ? $apiError : 'SMS send failed.'];
    }
}
