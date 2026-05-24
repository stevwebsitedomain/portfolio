<?php

declare(strict_types=1);

namespace Portfolio\Api;

final class Env
{
    /** @var list<string> */
    private const KEYS = [
        'BREVO_API_KEY',
        'RESEND_API_KEY',
        'MAIL_TRANSPORT',
        'MAILER_DSN',
        'SENDER_EMAIL',
        'SENDER_NAME',
        'CONTACT_EMAIL',
        'SMTP_HOST',
        'SMTP_PORT',
        'SMTP_USER',
        'SMTP_PASSWORD',
        'SMTP_PASS',
        'SMTP_ENCRYPTION',
        'MAIL_DEBUG',
    ];

    public static function get(string $name, string $default = ''): string
    {
        $value = self::read($name);
        if ($value !== '') {
            return $value;
        }

        return $default;
    }

    public static function isSet(string $name): bool
    {
        return self::read($name) !== '';
    }

    /**
     * Ensure Render/Apache env vars are visible to getenv() and $_ENV.
     */
    public static function bootstrap(): void
    {
        foreach (self::KEYS as $name) {
            $value = self::read($name);
            if ($value === '') {
                continue;
            }

            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
            putenv($name . '=' . $value);
        }
    }

    private static function read(string $name): string
    {
        $candidates = [
            $_ENV[$name] ?? null,
            getenv($name),
            $_SERVER[$name] ?? null,
        ];

        foreach ($candidates as $value) {
            if (!is_string($value)) {
                continue;
            }

            $trimmed = trim($value);
            if ($trimmed !== '') {
                return $trimmed;
            }
        }

        return '';
    }
}
