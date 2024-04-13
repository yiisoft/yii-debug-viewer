<?php

declare(strict_types=1);

return [
    'yiisoft/yii-debug-viewer' => [
        'viewerUrl' => '/debug',
        'backendUrl' => 'http://127.0.0.1:8080',
        'editorUrl' => 'phpstorm://open?url=file://{file}&line={line}',

        'devPanelContainerId' => 'yii-dev-panel',
        'toolbarContainerId' => 'yii-debug-toolbar',

        // for dev purposes http://localhost:4173
        'devPanelStaticUrl' => 'https://yiisoft.github.io/yii-dev-panel',
        'toolbarStaticUrl' => 'https://yiisoft.github.io/yii-dev-panel/toolbar',
    ],
];
