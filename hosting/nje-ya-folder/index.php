<?php

declare(strict_types=1);

/**
 * NJE YA FOLDER — weka faili hili kwenye public_html kuu
 * (pale palipo butra, OnlineStock, My-PortiFolio).
 *
 * Hii inafungua Yii3 kutoka ndani ya folder My-PortiFolio.
 * Kama domain kuu ina site yake tayari, USIBADILISHE index.php ya huko —
 * tumia toleo la ndani tu: My-PortiFolio/index.php
 */
$publicIndex = __DIR__
    . DIRECTORY_SEPARATOR . 'My-PortiFolio'
    . DIRECTORY_SEPARATOR . 'public'
    . DIRECTORY_SEPARATOR . 'index.php';

if (!is_file($publicIndex)) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "Yii3 haikupatikana. Hakikisha folder My-PortiFolio ipo kwenye public_html.\n";
    exit(1);
}

require $publicIndex;
