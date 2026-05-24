<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class JsonResponse
{
    public static function send(int $status, array $payload): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public static function error(int $status, string $message, array $extra = []): void
    {
        error_log('[Portfolio API] HTTP ' . $status . ': ' . $message);

        self::send($status, array_merge([
            'ok' => false,
            'success' => false,
            'error' => $message,
            'message' => $message,
        ], $extra));
    }
}
