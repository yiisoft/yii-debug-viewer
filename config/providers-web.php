<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\DebugViewerProvider;

if (!(bool)($params['yiisoft/yii-debug-viewer']['enabled'] ?? false)) {
    return [];
}

return [
    'yiisoft/yii-debug-viewer' => DebugViewerProvider::class,
];
