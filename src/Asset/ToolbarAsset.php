<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

final class ToolbarAsset extends AssetBundle
{
    public bool $cdn = true;

    public array $js = [
        //'https://yiisoft.github.io/yii-dev-panel/toolbar/bundle.js',
        [
            'http://localhost:4173/toolbar/bundle.js',
            WebView::POSITION_END,
            'type' => 'module'
        ],
    ];

    public array $css = [
        //'https://yiisoft.github.io/yii-dev-panel/toolbar/bundle.css',
        'http://localhost:4173/toolbar/bundle.css',
    ];
}
