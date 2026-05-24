<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Cors
{
    public static function apply(): void
    {
        if (headers_sent()) {
            return;
        }

        // Avoid duplicate CORS headers if something else already set them
        foreach (headers_list() as $h) {
            if (stripos($h, 'Access-Control-Allow-Origin:') === 0) {
                return;
            }
        }

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        // Allow all frontend origins (Vercel, localhost, Render)
        if ($origin !== '') {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Vary: Origin');
        } else {
            header('Access-Control-Allow-Origin: *');
        }

        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, X-Portfolio-Debug');
        header('Access-Control-Max-Age: 86400');
    }

    public static function handlePreflight(): bool
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
            http_response_code(204);
            return true;
        }

        return false;
    }
}
