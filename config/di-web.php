<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/** @var array $params */

return [
    ToolbarMiddleware::class => [
        '__construct()' => [
            'apiUrl' => $params['yiisoft/yii-debug-viewer']['apiUrl'],
            'editorUrl' => $params['yiisoft/yii-debug-viewer']['editorUrl'],
            'containerId' => $params['yiisoft/yii-debug-viewer']['containerId'],
        ],
    ],
];
