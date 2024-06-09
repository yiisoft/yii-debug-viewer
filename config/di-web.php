<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Middleware\DevPanelMiddleware;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/** @var array $params */

$viewerParams = $params['yiisoft/yii-debug-viewer'];

return [
    ToolbarMiddleware::class => [
        '__construct()' => [
            'containerId' => $viewerParams['toolbarContainerId'],
            'viewerUrl' => $viewerParams['viewerUrl'],
            'backendUrl' => $viewerParams['backendUrl'],
            'editorUrl' => $viewerParams['editorUrl'],

            'staticUrl' => $viewerParams['toolbarStaticUrl'],
        ],
    ],
    DevPanelMiddleware::class => [
        '__construct()' => [
            'containerId' => $viewerParams['devPanelContainerId'],
            'viewerUrl' => $viewerParams['viewerUrl'],
            'backendUrl' => $viewerParams['backendUrl'],
            'editorUrl' => $viewerParams['editorUrl'],

            'staticUrl' => $viewerParams['devPanelStaticUrl'],
        ],
    ],
];
