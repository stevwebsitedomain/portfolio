<?php

declare(strict_types=1);

$baseUrl = require __DIR__ . '/base-url.php';

return [
    '@root' => dirname(__DIR__, 2),
    '@src' => '@root/src',
    '@assets' => '@root/public/assets-runtime',
    '@assetsUrl' => ($baseUrl === '' ? '' : $baseUrl) . '/assets-runtime',
    '@assetsSource' => '@root/assets',
    '@baseUrl' => $baseUrl,
    '@public' => '@root/public',
    '@runtime' => '@root/runtime',
    '@vendor' => '@root/vendor',
    '@data' => '@root/data',
];
