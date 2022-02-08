<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__),
            '@assets' => '@root/public/assets',
            '@assetsUrl' => '@baseUrl/assets',
            '@baseUrl' => '/',
            '@message' => '@root/resources/message',
            '@npm' => '@root/node_modules',
            '@public' => '@root/public',
            '@resources' => '@root/resources',
            '@runtime' => '@root/runtime',
            '@vendor' => '@root/vendor',
            '@layout' => '@resources/views/layout',
            '@views' => '@resources/views',
        ],
    ],
    'yiisoft/yii-debug-viewer' => [
        'baseUrl' => '',
        'viewerUrl' => '',
    ],
];
