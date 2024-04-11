<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Asset\DevPanelAsset;
use Yiisoft\Yii\Debug\Viewer\Asset\ToolbarAsset;
use Yiisoft\Yii\Debug\Viewer\Middleware\DevPanelMiddleware;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/** @var array $params */

$viewerParams = $params['yiisoft/yii-debug-viewer'];

return [
    ToolbarAsset::class => [
        '__construct()' => [
            'staticUrl' => $viewerParams['toolbarStaticUrl'],
        ],
    ],
    DevPanelAsset::class => [
        '__construct()' => [
            'staticUrl' => $viewerParams['devPanelStaticUrl'],
            'registerServiceWorker' => (bool)$viewerParams['registerServiceWorker'],
        ],
    ],
    ToolbarMiddleware::class => [
        '__construct()' => [
            'containerId' => $viewerParams['toolbarContainerId'],
            'viewerUrl' => $viewerParams['viewerUrl'],
            'backendUrl' => $viewerParams['backendUrl'],
            'editorUrl' => $viewerParams['editorUrl'],
        ],
    ],
    DevPanelMiddleware::class => [
        '__construct()' => [
            'containerId' => $viewerParams['devPanelContainerId'],
            'viewerUrl' => $viewerParams['viewerUrl'],
            'backendUrl' => $viewerParams['backendUrl'],
            'editorUrl' => $viewerParams['editorUrl'],
        ],
    ],
];
