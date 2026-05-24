<?php

declare(strict_types=1);

use Portfolio\Api\ContactHandler;
use Portfolio\Api\Cors;
use Portfolio\Api\JsonResponse;
use Portfolio\Api\Mailer;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    Portfolio\Api\Env::bootstrap();
    $config = require dirname(__DIR__) . '/config.php';

    Cors::apply();
    if (Cors::handlePreflight()) {
        exit;
    }

    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $path = rtrim($path, '/') ?: '/';

    if (str_starts_with($path, '/site') || $path === '/index.php') {
        header('Location: /', true, 302);
        exit;
    }

    if ($path === '/' && $method === 'GET') {
        $mailer = new Mailer($config);
        JsonResponse::send(200, array_merge([
            'ok' => true,
            'service' => 'Portfolio API',
            'organization' => $config['senderName'],
            'endpoints' => [
                'GET /api/portfolio' => 'Portfolio JSON data',
                'GET /api/contact' => 'Contact endpoint diagnostics',
                'POST /api/contact' => 'Contact form (sends email)',
            ],
            'mailConfigured' => $mailer->isConfigured(),
            'mailReady' => $mailer->isReadyForCurrentHost(),
        ], $mailer->getDiagnostics(), [
            'note' => 'On Render: mailReady requires BREVO_API_KEY or RESEND_API_KEY (SMTP is blocked).',
        ]));
        exit;
    }

    if ($path === '/api/portfolio' && in_array($method, ['GET', 'HEAD'], true)) {
        $file = dirname(__DIR__) . '/data/portfolio.json';
        if (!is_readable($file)) {
            JsonResponse::error(500, 'Portfolio data not available.');
            exit;
        }
        $json = file_get_contents($file);
        http_response_code(200);
        header('Content-Type: application/json; charset=UTF-8');
        echo $json;
        exit;
    }

    if ($path === '/api/contact' && $method === 'GET') {
        $mailer = new Mailer($config);
        JsonResponse::send(200, array_merge([
            'ok' => true,
            'endpoint' => 'POST /api/contact',
            'method' => 'Send JSON: { name, email, subject, message }',
            'mailConfigured' => $mailer->isConfigured(),
            'mailReady' => $mailer->isReadyForCurrentHost(),
        ], $mailer->getDiagnostics(), [
            'hint' => $mailer->isReadyForCurrentHost()
                ? 'Ready to accept POST requests.'
                : 'Add BREVO_API_KEY on Render, redeploy, then mailReady should become true.',
        ]));
        exit;
    }

    if ($path === '/api/contact' && $method === 'POST') {
        (new ContactHandler($config, new Mailer($config)))->handle();
        exit;
    }

    JsonResponse::error(404, 'Not found.');
} catch (Throwable $e) {
    error_log('[Portfolio API] Uncaught: ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());

    if (!headers_sent()) {
        Cors::apply();
    }

    $debug = getenv('MAIL_DEBUG') === '1' || getenv('MAIL_DEBUG') === 'true';
    JsonResponse::error(500, 'Internal server error.', $debug ? [
        'debug' => $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine(),
    ] : []);
}
