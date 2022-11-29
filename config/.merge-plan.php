<?php

declare(strict_types=1);

// Do not edit. Content will be replaced.
return [
    '/' => [
        'params' => [
            'yiisoft/assets' => [
                'config/params.php',
            ],
            'yiisoft/data-response' => [
                'config/params.php',
            ],
            'yiisoft/view' => [
                'config/params.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/params.php',
            ],
            'yiisoft/aliases' => [
                'config/params.php',
            ],
            'yiisoft/log-target-file' => [
                'config/params.php',
            ],
            'yiisoft/yii-console' => [
                'config/params.php',
            ],
            '/' => [
                'params.php',
            ],
        ],
        'web' => [
            'yiisoft/assets' => [
                'config/web.php',
            ],
            'yiisoft/data-response' => [
                'config/web.php',
            ],
            'yiisoft/view' => [
                'config/web.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/web.php',
            ],
            'yiisoft/error-handler' => [
                'config/web.php',
            ],
            'yiisoft/middleware-dispatcher' => [
                'config/web.php',
            ],
            'yiisoft/yii-event' => [
                'config/web.php',
            ],
            '/' => [
                'web.php',
            ],
        ],
        'common' => [
            'yiisoft/view' => [
                'config/common.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/common.php',
            ],
            'yiisoft/aliases' => [
                'config/common.php',
            ],
            'yiisoft/cache' => [
                'config/common.php',
            ],
            'yiisoft/log-target-file' => [
                'config/common.php',
            ],
            'yiisoft/router' => [
                'config/common.php',
            ],
            'yiisoft/yii-event' => [
                'config/common.php',
            ],
        ],
        'events-console' => [
            'yiisoft/log' => [
                'config/events-console.php',
            ],
            'yiisoft/yii-console' => [
                'config/events-console.php',
            ],
            'yiisoft/yii-event' => [
                '$events',
                'config/events-console.php',
            ],
        ],
        'events-web' => [
            'yiisoft/log' => [
                'config/events-web.php',
            ],
            'yiisoft/yii-event' => [
                '$events',
                'config/events-web.php',
            ],
        ],
        'console' => [
            'yiisoft/yii-console' => [
                'config/console.php',
            ],
            'yiisoft/yii-event' => [
                'config/console.php',
            ],
        ],
        'providers-console' => [
            'yiisoft/yii-console' => [
                'config/providers-console.php',
            ],
        ],
        'events' => [
            'yiisoft/yii-event' => [
                'config/events.php',
            ],
        ],
        'routes' => [
            '/' => [
                'routes.php',
            ],
        ],
    ],
    'yii-debug-viewer-app' => [
        'common' => [
            '/' => [
                'app/common.php',
            ],
        ],
        'params' => [
            '/' => [
                'app/params.php',
            ],
        ],
        'console' => [
            '/' => [
                '$common',
                'app/console.php',
            ],
        ],
        'web' => [
            '/' => [
                '$common',
                'app/web.php',
            ],
        ],
        'events' => [
            '/' => [
                'app/events.php',
            ],
        ],
        'events-web' => [
            '/' => [
                '$events',
                'app/events-web.php',
            ],
        ],
        'events-console' => [
            '/' => [
                '$events',
                'app/events-console.php',
            ],
        ],
        'providers' => [
            '/' => [
                'app/providers.php',
            ],
        ],
        'providers-web' => [
            '/' => [
                '$providers',
                'app/providers-web.php',
            ],
        ],
        'providers-console' => [
            '/' => [
                '$providers',
                'app/providers-console.php',
            ],
        ],
        'routes' => [
            '/' => [
                'app/routes.php',
            ],
        ],
        'bootstrap' => [
            '/' => [
                'app/bootstrap.php',
            ],
        ],
        'bootstrap-web' => [
            '/' => [
                '$bootstrap',
                'app/bootstrap-web.php',
            ],
        ],
        'bootstrap-console' => [
            '/' => [
                '$bootstrap',
                'app/bootstrap-console.php',
            ],
        ],
    ],
];
