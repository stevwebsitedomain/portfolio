<?php

declare(strict_types=1);

/**
 * NDANI YA FOLDER — nakala ya My-PortiFolio/index.php
 * Weka hii ndani ya My-PortiFolio (sio kwenye public_html kuu).
 */
$publicIndex = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';

if (!is_file($publicIndex)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Yii3 public/index.php was not found next to this file.\n";
    exit(1);
}

require $publicIndex;
