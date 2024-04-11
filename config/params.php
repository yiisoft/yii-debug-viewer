<?php

declare(strict_types=1);

return [
    'yiisoft/yii-debug-viewer' => [
        'viewerUrl' => 'debug',
        'backendUrl' => 'http://127.0.0.1:8080',
        'devPanelContainerId' => 'yii-dev-panel',
        'toolbarContainerId' => 'yii-debug-toolbar',
        'editorUrl' => 'phpstorm://open?url=file://{file}&line={line}',
    ],
];
