<?php

declare(strict_types=1);

$file = __DIR__ . '/files/Steven_Abalwambo_CV.pdf';
if (!is_file($file)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=UTF-8');
    echo 'CV not found';
    exit;
}

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Steven_Abalwambo_CV.pdf"');
header('Content-Length: ' . (string) filesize($file));
header('X-Content-Type-Options: nosniff');
header('Cache-Control: private, max-age=3600');
readfile($file);
