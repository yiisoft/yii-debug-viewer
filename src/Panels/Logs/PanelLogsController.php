<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Panels\Logs;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

final class PanelLogsController
{
    private DataResponseFactoryInterface $responseFactory;

    /**
     * PanelLogsController constructor.
     */
    public function __construct(
        DataResponseFactoryInterface $responseFactory
    ) {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return ResponseInterface
     */
    public function view(): ResponseInterface
    {
        return $this->responseFactory->createResponse(file_get_contents(__DIR__ . '/view.html'));
    }
}
