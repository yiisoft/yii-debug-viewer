<?php

declare(strict_types=1);

return [
    'yiisoft/yii-debug-viewer' => [
        'enabled' => true,
        'targetHost' => '/',
        'apiUrl' => '/debug/api',
        'viewerUrl' => '/debug',
        'backendUrl' => 'http://127.0.0.1:8090',
        'containerId' => 'yii-debug-toolbar',
        'editorUrl' => 'phpstorm://open?url=file://{file}&line={line}',
    ],
];
