<?php

declare(strict_types=1);

/**
 * Contact form SMS via meseji.co.tz (sender NOTICE). WhatsApp is opened in the browser.
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

$apiKey = $envGet('MESEJI_API_KEY', 'zs_70c4072ea92318931582f47a96b9e73c2a363e09f5a80039');
if ($apiKey === '') {
    http_response_code(503);
    echo json_encode(['ok' => false, 'message' => 'Messaging is not configured.']);
    exit;
}

$text = "Portfolio contact\nName: {$name}\nEmail: {$email}\n"
    . ($phone !== '' ? "Phone: {$phone}\n" : '')
    . "Subject: {$subject}\n\n{$message}";

$smsTo = $envGet('MESEJI_SMS_TO', '255622045972');
$sender = $envGet('MESEJI_SENDER', 'NOTICE');

$ch = curl_init('https://meseji.co.tz/api/v1/sms/send');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Accept: application/json',
        'Content-Type: application/json',
        'X-API-Key: ' . $apiKey,
    ],
    CURLOPT_POSTFIELDS => json_encode([
        'sender_id' => $sender,
        'message' => $text,
        'contacts' => $smsTo,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
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
