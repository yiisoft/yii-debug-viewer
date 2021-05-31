<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

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
        return $this->responseFactory->createResponse(file_get_contents(dirname(__DIR__) . '/public/index.html'));
    }
}
