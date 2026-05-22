<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Cors
{
    /**
     * @param list<string> $allowedOrigins
     */
    public static function apply(array $allowedOrigins): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if ($origin !== '' && self::isOriginAllowed($origin, $allowedOrigins)) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Vary: Origin');
        }

        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept');
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

    /**
     * @param list<string> $allowedOrigins
     */
    private static function isOriginAllowed(string $origin, array $allowedOrigins): bool
    {
        if (in_array('*', $allowedOrigins, true)) {
            return true;
        }

        if (in_array($origin, $allowedOrigins, true)) {
            return true;
        }

        // Vercel production + preview URLs
        if (preg_match('#^https://[\w.-]+\.vercel\.app$#i', $origin) === 1) {
            return true;
        }

        // Local dev (XAMPP, php -S, Live Server)
        if (preg_match('#^https?://(localhost|127\.0\.0\.1)(:\d+)?$#i', $origin) === 1) {
            return true;
        }

        return false;
    }
}
