<?php

declare(strict_types=1);

/**
 * NDANI YA FOLDER — weka faili hili ndani ya My-PortiFolio
 * (pamoja na .htaccess, public/, src/, vendor/, config/).
 *
 * Usiweke faili hili kwenye public_html kuu.
 * Toleo la nje lipo: hosting/nje-ya-folder/index.php
 */
$publicIndex = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';

if (!is_file($publicIndex)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Yii3 public/index.php was not found next to this file.\n";
    exit(1);
}

require $publicIndex;
