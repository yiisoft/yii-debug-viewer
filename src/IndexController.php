<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Router\CurrentRoute;

final class IndexController
{
    private DataResponseFactoryInterface $responseFactory;

    /**
     * IndexController constructor.
     */
    public function __construct(
        DataResponseFactoryInterface $responseFactory
    ) {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        return $this->responseFactory->createResponse(file_get_contents(dirname(__DIR__) . '/resources/views/index.html'));
    }

    public function panel(CurrentRoute $currentRoute, PanelCollection $panelCollection): ResponseInterface
    {
        $panel = $panelCollection->getPanel($currentRoute->getArgument('panel'));
        return $this->responseFactory->createResponse($panel->renderDetail());
    }

    public function toolbar(ServerRequestInterface $request)
    {
        return $this->responseFactory->createResponse();
    }
}
