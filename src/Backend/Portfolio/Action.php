<?php

declare(strict_types=1);

namespace App\Backend\Portfolio;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Yiisoft\Aliases\Aliases;

final readonly class Action
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory,
        private Aliases $aliases,
    ) {}

    public function __invoke(): ResponseInterface
    {
        $file = $this->aliases->get('@root') . '/data/portfolio.json';
        if (!is_readable($file)) {
            $body = $this->streamFactory->createStream(json_encode([
                'ok' => false,
                'message' => 'Portfolio data not available.',
            ], JSON_UNESCAPED_SLASHES) ?: '{}');

            return $this->responseFactory
                ->createResponse(500)
                ->withHeader('Content-Type', 'application/json; charset=UTF-8')
                ->withBody($body);
        }

        $json = (string) file_get_contents($file);

        return $this->responseFactory
            ->createResponse(200)
            ->withHeader('Content-Type', 'application/json; charset=UTF-8')
            ->withBody($this->streamFactory->createStream($json));
    }
}
