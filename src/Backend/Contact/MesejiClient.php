<?php

declare(strict_types=1);

namespace App\Backend\Contact;

final class MesejiClient
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $sender,
        private readonly string $whatsappToken = '',
        private readonly string $smsBaseUrl = 'https://meseji.co.tz/api/v1',
        private readonly string $whatsappBaseUrl = 'https://api.meseji.app/api/v1',
    ) {}

    /**
     * Normal SMS via meseji.co.tz
     *
     * @return array{ok:bool,error:string}
     */
    public function sendSms(string $to, string $message): array
    {
        $res = $this->post(
            rtrim($this->smsBaseUrl, '/') . '/sms/send',
            [
                'sender_id' => $this->sender,
                'message' => $message,
                'contacts' => $to,
            ],
            ['X-API-Key: ' . $this->apiKey],
        );

        return $this->outcome($res, 'SMS send failed.');
    }

    /**
     * Real WhatsApp chat via Meseji WhatsApp API (not SMS).
     *
     * @return array{ok:bool,error:string}
     */
    public function sendWhatsApp(string $to, string $message): array
    {
        $token = $this->whatsappToken !== '' ? $this->whatsappToken : $this->apiKey;
        $res = $this->post(
            rtrim($this->whatsappBaseUrl, '/') . '/whatsapp/messages/text',
            [
                'to' => $to,
                'text' => $message,
            ],
            ['Authorization: Bearer ' . $token],
        );

        return $this->outcome($res, 'WhatsApp send failed.');
    }

    /**
     * @param array{ok:bool,status:int,error:string} $res
     * @return array{ok:bool,error:string}
     */
    private function outcome(array $res, string $fallback): array
    {
        if ($res['ok']) {
            return ['ok' => true, 'error' => ''];
        }

        $error = $res['error'] !== '' ? $res['error'] : $fallback;
        if ($res['status'] === 401 || stripos($error, 'token') !== false || stripos($error, 'unauthorized') !== false) {
            $error = 'Meseji rejected the API key or WhatsApp token.';
        }

        return ['ok' => false, 'error' => $error];
    }

    /**
     * @param array<string, mixed> $payload
     * @param list<string> $authHeaders
     * @return array{ok:bool,status:int,error:string}
     */
    private function post(string $url, array $payload, array $authHeaders): array
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array_merge([
                'Accept: application/json',
                'Content-Type: application/json',
            ], $authHeaders),
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            CURLOPT_TIMEOUT => 25,
            CURLOPT_CONNECTTIMEOUT => 12,
        ]);
        $raw = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($raw === false) {
            return ['ok' => false, 'status' => 0, 'error' => $curlErr ?: 'Network error'];
        }

        $body = json_decode((string) $raw, true);
        if (!is_array($body)) {
            $body = [];
        }

        $apiError = '';
        foreach (['error', 'msg', 'detail'] as $key) {
            if (!empty($body[$key]) && is_string($body[$key])) {
                $apiError = $body[$key];
                break;
            }
        }
        if ($apiError === '' && !empty($body['message']) && is_string($body['message']) && $status >= 400) {
            $apiError = $body['message'];
        }

        $ok = $status >= 200 && $status < 300
            && $apiError === ''
            && ($body['status'] ?? 'success') !== false
            && ($body['ok'] ?? true) !== false
            && ($body['success'] ?? true) !== false;

        return ['ok' => $ok, 'status' => $status, 'error' => $apiError];
    }
}
