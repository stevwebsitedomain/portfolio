<?php

declare(strict_types=1);

namespace App\Web\ServicesPage;

use App\Web\PageRenderer;
use Psr\Http\Message\ResponseInterface;

final readonly class Action
{
    public function __construct(
        private PageRenderer $pages,
    ) {}

    public function __invoke(): ResponseInterface
    {
        return $this->pages->render(__DIR__ . '/template');
    }
}
