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

];