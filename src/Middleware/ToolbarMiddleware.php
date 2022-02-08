<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Debug\Viewer\Asset\ToolbarAsset;

final class ToolbarMiddleware implements MiddlewareInterface
{
    public function __construct(private string $toolbarUrl, private AssetManager $assetManager, private WebView $view)
    {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->assetManager->register(ToolbarAsset::class);
        $this->view->registerJs(
            <<<JS
window.YiiDebug.initToolbar('$this->toolbarUrl', '/debug/')
JS
        );

        return $handler->handle($request);
    }
}
