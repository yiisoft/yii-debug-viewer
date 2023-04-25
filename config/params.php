<?php

declare(strict_types=1);

return [
    'yiisoft/yii-debug-viewer' => [
        'enabled' => true,
        'targetHost' => '/',
        'apiUrl' => '/debug/api',
        'viewerUrl' => '/debug',
        'containerId' => 'yii-debug-toolbar',
        'editorUrl' => 'phpstorm://open?url=file://{file}&line={line}',
    ],
];
