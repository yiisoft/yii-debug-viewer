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
        'di-web' => [
            'yiisoft/assets' => [
                'config/di-web.php',
            ],
            'yiisoft/data-response' => [
                'config/di-web.php',
            ],
            'yiisoft/view' => [
                'config/di-web.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/di-web.php',
            ],
            'yiisoft/error-handler' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-event' => [
                'config/di-web.php',
            ],
            '/' => [
                'di-web.php',
            ],
        ],
        'di' => [
            'yiisoft/view' => [
                'config/di.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/di.php',
            ],
            'yiisoft/aliases' => [
                'config/di.php',
            ],
            'yiisoft/cache' => [
                'config/di.php',
            ],
            'yiisoft/log-target-file' => [
                'config/di.php',
            ],
            'yiisoft/router' => [
                'config/di.php',
            ],
            'yiisoft/yii-event' => [
                'config/di.php',
            ],
        ],
        'events-console' => [
            'yiisoft/log' => [
                'config/events-console.php',
            ],
            'yiisoft/yii-console' => [
                'config/events-console.php',
            ],
        ],
        'events-web' => [
            'yiisoft/log' => [
                'config/events-web.php',
            ],
        ],
        'di-console' => [
            'yiisoft/yii-console' => [
                'config/di-console.php',
            ],
            'yiisoft/yii-event' => [
                'config/di-console.php',
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
