<?php

declare(strict_types=1);

use Portfolio\Api\ContactHandler;
use Portfolio\Api\Cors;
use Portfolio\Api\JsonResponse;
use Portfolio\Api\Mailer;

require dirname(__DIR__) . '/vendor/autoload.php';

$config = require dirname(__DIR__) . '/config.php';

Cors::apply();
if (Cors::handlePreflight()) {
    exit;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rtrim($path, '/') ?: '/';

// Old Yii2 URLs → home (no login page)
if (str_starts_with($path, '/site') || $path === '/index.php') {
    header('Location: /', true, 302);
    exit;
}

if ($path === '/' && $method === 'GET') {
    JsonResponse::send(200, [
        'ok' => true,
        'service' => 'Portfolio API',
        'organization' => $config['senderName'],
        'endpoints' => [
            'GET /api/portfolio' => 'Portfolio JSON data',
            'POST /api/contact' => 'Contact form (sends email)',
        ],
    ]);
    exit;
}

if ($path === '/api/portfolio' && in_array($method, ['GET', 'HEAD'], true)) {
    $file = dirname(__DIR__) . '/data/portfolio.json';
    if (!is_readable($file)) {
        JsonResponse::send(500, ['ok' => false, 'error' => 'Portfolio data not available.']);
        exit;
    }
    $json = file_get_contents($file);
    http_response_code(200);
    header('Content-Type: application/json; charset=UTF-8');
    echo $json;
    exit;
}

if ($path === '/api/contact' && $method === 'POST') {
    (new ContactHandler($config, new Mailer($config)))->handle();
    exit;
}

JsonResponse::send(404, ['ok' => false, 'error' => 'Not found.']);
