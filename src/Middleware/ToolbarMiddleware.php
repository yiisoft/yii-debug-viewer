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
    public function __construct(
        private string $containerId,
        private string $viewerUrl,
        private string $backendUrl,
        private AssetManager $assetManager,
        private WebView $view,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->assetManager->register(ToolbarAsset::class);
        $this->view->registerJs(
            <<<JS
            const containerId = '{$this->containerId}';
            const container = document.createElement('div');
            container.setAttribute('id', containerId);
            container.style.flex = "1";
            document.body.append(container);

            console.log('window.YiiDevPanelToolbarWidget', window.YiiDevPanelToolbarWidget)
            window['YiiDevPanelToolbarWidget'] = window['YiiDevPanelToolbarWidget'] ?? {};
            window['YiiDevPanelToolbarWidget'].config = {
                containerId: containerId,
                options: {
                    router: {
                        basename: '{$this->viewerUrl}',
                    },
                    backend: {
                        baseUrl: '{$this->backendUrl}',
                    }
                },
            };
            JS,
            WebView::POSITION_LOAD,
        );

        return $handler->handle($request);
    }
}
