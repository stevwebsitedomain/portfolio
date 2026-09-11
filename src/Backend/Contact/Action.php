<?php

declare(strict_types=1);

namespace App\Backend\Contact;

use App\Shared\Env;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

final readonly class Action
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
    ) {}

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->withCors($this->responseFactory->createResponse());

        if ($request->getMethod() === 'OPTIONS') {
            return $response->withStatus(204);
        }

        if ($request->getMethod() !== 'POST') {
            return $this->json($response, 405, ['ok' => false, 'message' => 'Use POST.']);
        }

        $data = json_decode((string) $request->getBody(), true);
        if (!is_array($data)) {
            $data = (array) $request->getParsedBody();
        }

        if (trim((string) ($data['website'] ?? '')) !== '') {
            return $this->json($response, 200, ['ok' => true, 'message' => 'Thank you. Your message has been sent.']);
        }

        $name = trim((string) ($data['name'] ?? ''));
        $email = mb_strtolower(trim((string) ($data['email'] ?? '')));
        $phone = trim((string) ($data['phone'] ?? ''));
        $subject = trim((string) ($data['subject'] ?? ''));
        $message = trim((string) ($data['message'] ?? ''));
        $channel = strtolower(trim((string) ($data['channel'] ?? 'sms')));
        if (!in_array($channel, ['whatsapp', 'sms'], true)) {
            $channel = 'sms';
        }

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            return $this->json($response, 422, ['ok' => false, 'message' => 'Please fill in name, email, subject, and message.']);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json($response, 422, ['ok' => false, 'message' => 'Please enter a valid email address.']);
        }
        if (mb_strlen($name) > 120 || mb_strlen($subject) > 200 || mb_strlen($message) > 1500 || mb_strlen($phone) > 40) {
            return $this->json($response, 422, ['ok' => false, 'message' => 'One of the fields is too long.']);
        }

        $apiKey = Env::get('MESEJI_API_KEY', 'zs_70c4072ea92318931582f47a96b9e73c2a363e09f5a80039');
        if ($apiKey === '') {
            return $this->json($response, 503, ['ok' => false, 'message' => 'Messaging is not configured (MESEJI_API_KEY).']);
        }

        $text = "Portfolio contact\nName: {$name}\nEmail: {$email}\n"
            . ($phone !== '' ? "Phone: {$phone}\n" : '')
            . "Subject: {$subject}\n\n{$message}";

        $client = new MesejiClient(
            $apiKey,
            Env::get('MESEJI_SENDER', 'NOTICE'),
            Env::get('MESEJI_WHATSAPP_TOKEN'),
        );
        $sent = [];
        $errors = [];
        $whatsappUrl = null;
        $waTo = Env::get('MESEJI_WHATSAPP_TO', '255715296092');

        if ($channel === 'whatsapp') {
            $whatsappUrl = 'https://wa.me/' . rawurlencode($waTo) . '?text=' . rawurlencode($text);
            $sent[] = 'WhatsApp';
        }
        if ($channel === 'sms' || $channel === 'both') {
            $sms = $client->sendSms(Env::get('MESEJI_SMS_TO', '255622045972'), $text);
            if ($sms['ok']) {
                $sent[] = 'SMS';
            } else {
                $errors[] = $sms['error'] ?: 'SMS send failed.';
            }
        }

        if ($sent) {
            $payload = [
                'ok' => true,
                'message' => $whatsappUrl
                    ? 'WhatsApp will open with your message to +255 715 296 092. Tap Send.'
                    : 'Thank you. Your message has been sent.',
                'via' => $sent,
            ];
            if ($whatsappUrl !== null) {
                $payload['whatsappUrl'] = $whatsappUrl;
            }

            return $this->json($response, 200, $payload);
        }

        return $this->json($response, 502, [
            'ok' => false,
            'message' => $errors[0] ?? 'Message could not be sent. Please try WhatsApp or call.',
        ]);
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function json(ResponseInterface $response, int $status, array $payload): ResponseInterface
    {
        $body = $this->streamFactory->createStream(
            json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}',
        );

        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json; charset=UTF-8')
            ->withBody($body);
    }

    private function withCors(ResponseInterface $response): ResponseInterface
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        if ($origin !== '') {
            $response = $response
                ->withHeader('Access-Control-Allow-Origin', $origin)
                ->withHeader('Vary', 'Origin');
        } else {
            $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        }

        return $response
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept')
            ->withHeader('Access-Control-Max-Age', '86400');
    }
}
