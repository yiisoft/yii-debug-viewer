<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\Debug\Viewer\Panels\PanelInterface;

final class IndexController
{
    /**
     * IndexController constructor.
     */
    public function __construct(
        private DataResponseFactoryInterface $responseFactory
    ) {
    }

    public function index(UrlGeneratorInterface $urlGenerator): ResponseInterface
    {
        $content = file_get_contents(dirname(__DIR__) . '/resources/views/index.html');
        $content = strtr(
            $content,
            [
                '{TOOLBAR_CSS}' => $urlGenerator->generate('debug/toolbar/css'),
                '{CONFIG_URL}' => $urlGenerator->generate('debug/panels/config'),
            ]
        );

        return $this->responseFactory->createResponse($content);
    }

    public function panel(CurrentRoute $currentRoute, PanelCollection $panelCollection): ResponseInterface
    {
        if (($panel = $currentRoute->getArgument('panel')) === null) {
            return $this->responseFactory->createResponse(
                'Panel not found',
                404
            );
        }
        $panel = $panelCollection->getPanel($panel);
        return $this->responseFactory->createResponse($panel->renderDetail());
    }

    public function toolbar(
        ResponseFactoryInterface $responseFactory,
        PanelCollection $panelCollection
    ): ResponseInterface {
        $html = file_get_contents(dirname(__DIR__) . '/resources/views/toolbar.html');
        $panels = array_map(
            static fn (PanelInterface $panel) => $panel->renderSummary(),
            $panelCollection->getPanels()
        );
        $html = strtr($html, ['{TOOLBAR_BLOCKS}' => implode("\n", $panels)]);
        $response = $responseFactory
            ->createResponse()
            ->withHeader('Content-Type', 'text/html');
        $response
            ->getBody()
            ->write($html);
        return $response;
    }
}
