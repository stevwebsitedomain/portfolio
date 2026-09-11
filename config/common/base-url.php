<?php

declare(strict_types=1);

$scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim(dirname($scriptName), '/');
if (str_ends_with($baseUrl, '/public')) {
    $baseUrl = substr($baseUrl, 0, -strlen('/public'));
}
if ($baseUrl === '/' || $baseUrl === '.' || $baseUrl === '\\') {
    $baseUrl = '';
}

return $baseUrl;
