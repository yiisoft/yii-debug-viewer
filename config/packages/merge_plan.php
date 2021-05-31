<?php

declare(strict_types=1);

// Do not edit. Content will be replaced.
return [
    '/' => [
        'common' => [
            'yiisoft/log-target-file' => [
                'common.php',
            ],
            'yiisoft/router-fastroute' => [
                'common.php',
            ],
            'yiisoft/router' => [
                'common.php',
            ],
            'yiisoft/yii-event' => [
                'common.php',
            ],
            'yiisoft/aliases' => [
                'common.php',
            ],
            'yiisoft/validator' => [
                'common.php',
            ],
        ],
        'console' => [
            'yiisoft/yii-console' => [
                'console.php',
            ],
            'yiisoft/yii-event' => [
                'console.php',
            ],
        ],
        'events' => [
            'yiisoft/yii-event' => [
                'events.php',
            ],
        ],
        'events-console' => [
            'yiisoft/yii-console' => [
                'events-console.php',
            ],
            'yiisoft/log' => [
                'events-console.php',
            ],
            'yiisoft/yii-event' => [
                '$events',
                'events-console.php',
            ],
        ],
        'events-web' => [
            'yiisoft/log' => [
                'events-web.php',
            ],
            'yiisoft/yii-event' => [
                '$events',
                'events-web.php',
            ],
        ],
        'params' => [
            '/' => [
                'config/params.php',
            ],
            'yiisoft/log-target-file' => [
                'params.php',
            ],
            'yiisoft/router-fastroute' => [
                'params.php',
            ],
            'yiisoft/yii-console' => [
                'params.php',
            ],
            'yiisoft/aliases' => [
                'params.php',
            ],
        ],
        'providers-console' => [
            'yiisoft/yii-console' => [
                'providers-console.php',
            ],
        ],
        'routes' => [
            '/' => [
                'config/routes.php',
            ],
        ],
        'web' => [
            '/' => [
                'config/web.php',
            ],
            'yiisoft/data-response' => [
                'web.php',
            ],
            'yiisoft/error-handler' => [
                'web.php',
            ],
            'yiisoft/router-fastroute' => [
                'web.php',
            ],
            'yiisoft/middleware-dispatcher' => [
                'web.php',
            ],
            'yiisoft/yii-event' => [
                'web.php',
            ],
        ],
    ],
    'yii-debug-viewer-app' => [
        'common' => [
            '/' => [
                'config/app/common.php',
            ],
        ],
        'console' => [
            '/' => [
                '$common',
                'config/app/console.php',
            ],
        ],
        'events' => [
            '/' => [
                'config/app/events.php',
            ],
        ],
        'events-console' => [
            '/' => [
                '$events',
                'config/app/events-console.php',
            ],
        ],
        'events-web' => [
            '/' => [
                '$events',
                'config/app/events-web.php',
            ],
        ],
        'params' => [
            '/' => [
                'config/app/params.php',
            ],
        ],
        'providers' => [
            '/' => [
                'config/app/providers.php',
            ],
        ],
        'providers-console' => [
            '/' => [
                '$providers',
                'config/app/providers-console.php',
            ],
        ],
        'providers-web' => [
            '/' => [
                '$providers',
                'config/app/providers-web.php',
            ],
        ],
        'routes' => [
            '/' => [
                'config/app/routes.php',
            ],
        ],
        'web' => [
            '/' => [
                '$common',
                'config/app/web.php',
            ],
        ],
    ],
];
