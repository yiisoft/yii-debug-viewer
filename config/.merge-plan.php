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
        'di-web' => [
            '/' => [
                'di-web.php',
            ],
        ],
        'routes' => [
            '/' => [
                'routes.php',
            ],
        ],
    ],
    'yii-debug-viewer-app' => [
        'params' => [
            '/' => [
                'app/params.php',
            ],
        ],
        'di' => [
            '/' => [
                'app/di.php',
            ],
        ],
        'di-console' => [
            '/' => [
                '$di',
            ],
        ],
        'di-web' => [
            '/' => [
                '$di',
                'app/web.php',
            ],
        ],
        'events' => [
            '/' => [],
        ],
        'events-web' => [
            '/' => [
                '$events',
            ],
        ],
        'events-console' => [
            '/' => [
                '$events',
            ],
        ],
        'di-providers' => [
            '/' => [],
        ],
        'di-providers-web' => [
            '/' => [
                '$di-providers',
            ],
        ],
        'di-providers-console' => [
            '/' => [
                '$di-providers',
            ],
        ],
        'routes' => [
            '/' => [],
        ],
        'bootstrap' => [
            '/' => [],
        ],
        'bootstrap-web' => [
            '/' => [
                '$bootstrap',
            ],
        ],
        'bootstrap-console' => [
            '/' => [
                '$bootstrap',
            ],
        ],
    ],
];
