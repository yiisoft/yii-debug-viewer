<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

final class DevPanelAsset extends AssetBundle
{
    public bool $cdn = true;

    public array $js = [
        [
            'https://yiisoft.github.io/yii-dev-panel/bundle.js',
            WebView::POSITION_END,
            'type' => 'module',
        ],
        'https://yiisoft.github.io/yii-dev-panel/registerSW.js',
    ];

    public array $css = [
        'https://yiisoft.github.io/yii-dev-panel/bundle.css',
    ];
}
