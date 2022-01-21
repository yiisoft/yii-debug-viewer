<?php

declare(strict_types=1);

/**
 * @var array $params
 */

use Yiisoft\View\Event\WebView\BodyEnd;

if (!(bool)($params['yiisoft/yii-debug-viewer']['enabled'] ?? false)) {
    return [];
}

return [
    BodyEnd::class => [
        static function () use ($params) {
            echo '<div id="yii-debug-toolbar" data-url="' . $params['yiisoft/yii-debug-viewer']['toolbarUrl'] . '" style="display:none" class="yii-debug-toolbar-bottom"></div>';
        }
    ]
];