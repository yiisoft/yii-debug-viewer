<?php

declare(strict_types=1);

return [
    'yiisoft/yii-debug-viewer' => [
        'targetHost' => '/',
        'panels' => [
            'panel-info' => [
                'name' => 'Info',
                'route' => '/debug/panels/info'
            ],
            'panel-routes' => [
                'name' => 'Routes',
                'route' => '/debug/panels/routes'
            ],
        ],
    ],
];
