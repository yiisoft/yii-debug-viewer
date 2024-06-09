<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Debug\Viewer\Asset\ToolbarAsset;

final class ToolbarMiddleware implements MiddlewareInterface
{
    public function __construct(
        private string $containerId,
        private string $viewerUrl,
        private string $backendUrl,
        private string $editorUrl,
        private string $staticUrl,
        private AssetManager $assetManager,
        private WebView $view,
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $baseUriPrefix = $this->urlGenerator->getUriPrefix();
        $this->assetManager->registerCustomized(ToolbarAsset::class, ['baseUrl' => $this->staticUrl]);
        $this->view->registerJs(
            <<<JS
            (function(){
            const containerId = '{$this->containerId}';
            const container = document.createElement('div');
            container.setAttribute('id', containerId);
            container.style.flex = "0";
            document.body.append(container);

            window['YiiDevPanelToolbarWidget'] = window['YiiDevPanelToolbarWidget'] ?? {};
            window['YiiDevPanelToolbarWidget'].config = {
                containerId: containerId,
                options: {
                    application: {
                        editorUrl: '{$this->editorUrl}',
                    },
                    router: {
                        basename: '{$baseUriPrefix}',
                        useHashRouter: false,
                    },
                    backend: {
                        baseUrl: '{$this->backendUrl}{$baseUriPrefix}',
                    }
                },
            };
            })();
            JS,
            WebView::POSITION_LOAD,
        );

        return $handler->handle($request);
    }
}
