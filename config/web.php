<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Factory\PanelCollectionFactory;
use Yiisoft\Yii\Debug\Viewer\PanelCollection;

/** @var array $params */

return [
    PanelCollection::class => new PanelCollectionFactory($params['yiisoft/yii-debug-viewer']['panels']),
];
