<?php

declare(strict_types=1);

namespace App\Web;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

final readonly class PageRenderer
{
    public function __construct(
        private WebViewRenderer $viewRenderer,
        private Aliases $aliases,
    ) {}

    public function render(string $template): ResponseInterface
    {
        $baseUrl = rtrim(str_replace('\\', '/', $this->aliases->get('@baseUrl')), '/');

        return $this->viewRenderer
            ->withLayout('@src/Web/Shared/Layout/Blank/layout.php')
            ->render($template, ['baseUrl' => $baseUrl]);
    }
}
