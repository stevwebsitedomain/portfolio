<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Env
{
    public static function getBrevoApiKey(): string
    {
        $brevoApiKey = '';

        if (isset($_ENV['BREVO_API_KEY'])) {
            $brevoApiKey = $_ENV['BREVO_API_KEY'];
        }

        if (!$brevoApiKey && getenv('BREVO_API_KEY')) {
            $brevoApiKey = getenv('BREVO_API_KEY');
        }

        if (!$brevoApiKey && isset($_SERVER['BREVO_API_KEY'])) {
            $brevoApiKey = $_SERVER['BREVO_API_KEY'];
        }

        return self::normalizeApiKey(is_string($brevoApiKey) ? $brevoApiKey : '');
    }

    public static function get(string $name, string $default = ''): string
    {
        if ($name === 'BREVO_API_KEY') {
            $key = self::getBrevoApiKey();

            return $key !== '' ? $key : $default;
        }

        $value = $_ENV[$name] ?? getenv($name) ?: ($_SERVER[$name] ?? '');

        return is_string($value) && trim($value) !== '' ? trim($value) : $default;
    }

    public static function normalizeApiKey(string $key): string
    {
        $key = trim($key);
        $key = trim($key, "\"'");

        // Remove accidental line breaks/spaces from Render copy-paste
        return preg_replace('/\s+/', '', $key) ?? '';
    }

    public static function getBrevoKeyMeta(): array
    {
        $key = self::getBrevoApiKey();

        return [
            'brevoKeyLength' => strlen($key),
            'brevoKeyPrefix' => $key !== '' ? substr($key, 0, 8) : '',
            'brevoKeyLooksValid' => str_starts_with($key, 'xkeysib-'),
        ];
    }
}
