<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Factory\PanelCollectionFactory;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;
use Yiisoft\Yii\Debug\Viewer\PanelCollection;

/** @var array $params */

return [
    PanelCollection::class => new PanelCollectionFactory($params['yiisoft/yii-debug-viewer']['panels']),
    ToolbarMiddleware::class => [
        '__construct()' => [
            'toolbarUrl' => $params['yiisoft/yii-debug-viewer']['viewerUrl'],
            'apiUrl' => $params['yiisoft/yii-debug-viewer']['apiUrl'],
        ],
    ],
];
