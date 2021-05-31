<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__, 4),
            '@assets' => '@public/assets',
            '@assetsUrl' => '@baseUrl/assets',
            '@runtime' => '@root/runtime',
            '@src' => '@root/src',
            '@tests' => '@root/tests',
            '@views' => '@root/views',
        ],
    ],
];
