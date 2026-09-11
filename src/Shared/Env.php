<?php

declare(strict_types=1);

namespace App\Shared;

final class Env
{
    public static function loadDotenv(string $directory): void
    {
        $file = rtrim($directory, '/\\') . DIRECTORY_SEPARATOR . '.env';
        if (!is_file($file)) {
            return;
        }

        foreach (file($file, FILE_IGNORE_NEW_LINES) ?: [] as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (!str_contains($line, '=')) {
                continue;
            }
            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            if ($name === '') {
                continue;
            }
            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"'))
                || (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }
            $existing = getenv($name);
            if ($existing !== false && $existing !== '') {
                continue;
            }
            putenv($name . '=' . $value);
            $_ENV[$name] = $value;
        }
    }

    public static function get(string $name, string $default = ''): string
    {
        $value = $_ENV[$name] ?? getenv($name);
        if ($value === false || $value === null) {
            $value = $_SERVER[$name] ?? '';
        }
        if (!is_string($value)) {
            return $default;
        }
        $trimmed = trim($value);

        return $trimmed !== '' ? $trimmed : $default;
    }
}
