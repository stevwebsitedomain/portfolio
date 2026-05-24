<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Env
{
    public static function get(string $name, string $default = ''): string
    {
        $value = '';

        if (isset($_ENV[$name])) {
            $value = $_ENV[$name];
        } elseif (getenv($name)) {
            $value = getenv($name);
        } elseif (isset($_SERVER[$name])) {
            $value = $_SERVER[$name];
        }

        if (!is_string($value)) {
            return $default;
        }

        $trimmed = trim($value);

        return $trimmed !== '' ? $trimmed : $default;
    }

    public static function getGmailAppPassword(): string
    {
        $password = self::get('GMAIL_APP_PASSWORD');

        if ($password === '') {
            $password = self::get('SMTP_PASSWORD');
        }

        if ($password === '') {
            $password = self::get('SMTP_PASS');
        }

        // Gmail app passwords are 16 chars; remove spaces from copy-paste
        return preg_replace('/\s+/', '', $password) ?? '';
    }
}
