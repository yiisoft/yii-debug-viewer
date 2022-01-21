<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Panels\EventsPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\InfoPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\LogsPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\MiddlewaresPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\RequestPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\RoutesPanel;
use Yiisoft\Yii\Debug\Viewer\Panels\ServicesPanel;

return [
    'yiisoft/yii-debug-viewer' => [
        'enabled' => true,
        'targetHost' => '/',
        'toolbarUrl' => '/debug/toolbar',
        'panels' => [
            'info' => InfoPanel::class,
            'request' => RequestPanel::class,
            'routes' => RoutesPanel::class,
            'logs' => LogsPanel::class,
            'events' => EventsPanel::class,
            'services' => ServicesPanel::class,
            'middlewares' => MiddlewaresPanel::class,
        ],
    ],
];
