<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Debug\Viewer\Asset\DevPanelAsset;

final class DevPanelMiddleware implements MiddlewareInterface
{
    public function __construct(
        private string $viewerUrl,
        private AssetManager $assetManager,
        private WebView $view,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->assetManager->register(DevPanelAsset::class);
        $this->view->registerJs(
            <<<JS
            const devPanelContainerId = 'yii-dev-panel';
            const devPanel = document.createElement('div');
            devPanel.setAttribute('id', devPanelContainerId);
            devPanel.style.flex= "1";
            document.body.append(devPanel);

            console.log('window.YiiDevPanelWidget', window.YiiDevPanelWidget)
            window['YiiDevPanelWidget'] = window['YiiDevPanelWidget'] ?? {};
            window['YiiDevPanelWidget'].config = {
                containerId: devPanelContainerId,
                options: {
                    router: {
                        basename: '{$this->viewerUrl}',
                    }
                },
            };
            JS,
            WebView::POSITION_LOAD,
        );

        return $handler->handle($request);
    }
}
