<?php

namespace Yiisoft\Yii\Debug\Viewer\Panels;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

final class ConfigController
{
    private DataResponseFactoryInterface $responseFactory;
    private PanelCollection $panelCollection;

    /**
     * ConfigController constructor.
     */
    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        PanelCollection $panelCollection
    ) {
        $this->responseFactory = $responseFactory;
        $this->panelCollection = $panelCollection;
    }

    /**
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        return $this->responseFactory->createResponse($this->panelCollection->getPanels());
    }
}
