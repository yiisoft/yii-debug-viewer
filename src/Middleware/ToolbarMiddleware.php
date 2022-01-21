<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\EventDispatcher\Provider\ListenerCollection;
use Yiisoft\View\Event\WebView\BodyEnd;
use Yiisoft\View\Event\WebView\PageEnd;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Debug\Viewer\Asset\ToolbarAsset;

final class ToolbarMiddleware implements MiddlewareInterface
{
    public function __construct(private ListenerCollection $listenerCollection, private WebView $view)
    {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //$this->assetManager->register(ToolbarAsset::class);
        $css = file_get_contents(dirname(__DIR__, 2) . '/resources/assets/css/toolbar.css');
        $js = file_get_contents(dirname(__DIR__, 2) . '/resources/assets/js/toolbar.js');
        $this->view->registerJs($js);
        $this->view->registerCss($css, WebView::POSITION_END);

        return $handler->handle($request);
    }
}