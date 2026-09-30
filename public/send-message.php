<?php

declare(strict_types=1);

/**
 * Contact form SMS via Kilakona (sender TAARIFA). WhatsApp is opened in the browser.
 */
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept');
    http_response_code(204);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Use POST.']);
    exit;
}

$env = [];
foreach ([dirname(__DIR__), __DIR__, dirname(__DIR__, 2)] as $dir) {
    $file = $dir . DIRECTORY_SEPARATOR . '.env';
    if (!is_file($file)) {
        continue;
    }
    foreach (file($file, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$name, $value] = explode('=', $line, 2);
        $env[trim($name)] = trim($value, " \t\"'");
    }
    break;
}

$envGet = static function (string $name, string $default = '') use ($env): string {
    $value = $env[$name] ?? getenv($name);
    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return is_string($value) ? $value : $default;
};

$raw = file_get_contents('php://input') ?: '';
$data = json_decode($raw, true);
if (!is_array($data)) {
    $data = $_POST;
}

if (trim((string) ($data['website'] ?? '')) !== '') {
    echo json_encode(['ok' => true, 'message' => 'Thank you. Your message has been sent.']);
    exit;
}

$name = trim((string) ($data['name'] ?? ''));
$email = mb_strtolower(trim((string) ($data['email'] ?? '')));
$phone = trim((string) ($data['phone'] ?? ''));
$subject = trim((string) ($data['subject'] ?? ''));
$message = trim((string) ($data['message'] ?? ''));

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'Please fill in name, email, subject, and message.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$apiKey = $envGet('KILAKONA_API_KEY');
$apiSecret = $envGet('KILAKONA_API_SECRET');
if ($apiKey === '' || $apiSecret === '') {
    http_response_code(503);
    echo json_encode([
        'ok' => false,
        'message' => 'Messaging is not configured. Add KILAKONA_API_KEY and KILAKONA_API_SECRET in .env.',
    ]);
    exit;
}

$text = "Portfolio contact\nName: {$name}\nEmail: {$email}\n"
    . ($phone !== '' ? "Phone: {$phone}\n" : '')
    . "Subject: {$subject}\n\n{$message}";

$smsTo = $envGet('KILAKONA_SMS_TO', $envGet('MESEJI_SMS_TO', '255622045972'));
$sender = $envGet('KILAKONA_SENDER', 'TAARIFA');
$deliveryUrl = $envGet('KILAKONA_DELIVERY_URL');

$payload = [
    'senderId' => $sender,
    'messageType' => 'text',
    'message' => $text,
    'contacts' => $smsTo,
];
if ($deliveryUrl !== '') {
    $payload['deliveryReportUrl'] = $deliveryUrl;
}

$ch = curl_init('https://messaging.kilakona.co.tz/api/v1/vendor/message/send');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Accept: application/json',
        'Content-Type: application/json',
        'api_key: ' . $apiKey,
        'api_secret: ' . $apiSecret,
    ],
    CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    CURLOPT_TIMEOUT => 25,
    CURLOPT_CONNECTTIMEOUT => 12,
]);
$rawRes = curl_exec($ch);
$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr = curl_error($ch);
curl_close($ch);

$body = is_string($rawRes) ? json_decode($rawRes, true) : null;
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

$ok = $rawRes !== false
    && $status >= 200
    && $status < 300
    && $apiError === '';

if (!$ok) {
    http_response_code(502);
    echo json_encode([
        'ok' => false,
        'message' => $apiError !== '' ? $apiError : ($curlErr !== '' ? $curlErr : 'SMS send failed.'),
    ]);
    exit;
}

echo json_encode([
    'ok' => true,
    'message' => 'Thank you. Your SMS has been sent.',
    'via' => ['SMS'],
]);
