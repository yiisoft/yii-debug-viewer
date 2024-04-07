<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Middleware\DevPanelMiddleware;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/** @var array $params */

return [
    ToolbarMiddleware::class => [
        '__construct()' => [
            'containerId' => $params['yiisoft/yii-debug-viewer']['containerId'],
        ],
    ],
    DevPanelMiddleware::class => [
        '__construct()' => [
            'viewerUrl' => $params['yiisoft/yii-debug-viewer']['viewerUrl'],
        ],
    ],
];
