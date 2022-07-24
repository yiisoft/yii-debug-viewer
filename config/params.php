<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Panels\{
    EventsPanel,
    InfoPanel,
    LogsPanel,
    MiddlewaresPanel,
    RequestPanel,
    RoutesPanel,
    ServicesPanel,
    ValidatorsPanel
};

return [
    'yiisoft/yii-debug-viewer' => [
        'enabled' => true,
        'targetHost' => '/',
        'apiUrl' => '/debug/api',
        'viewerUrl' => '/debug',
        'editorUrl' => 'phpstorm://open?url=file://{file}&line={line}',
        'panels' => [
            'info'          => InfoPanel::class,
            'request'       => RequestPanel::class,
            'routes'        => RoutesPanel::class,
            'logs'          => LogsPanel::class,
            'events'        => EventsPanel::class,
            'services'      => ServicesPanel::class,
            'middlewares'   => MiddlewaresPanel::class,
            'validators'    => ValidatorsPanel::class,
        ],
    ],
];
