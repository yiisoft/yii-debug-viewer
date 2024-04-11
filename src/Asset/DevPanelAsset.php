<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

final class DevPanelAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [
        ['/bundle.js', WebView::POSITION_END, 'type' => 'module'],
    ];
    public array $css = [
        '/bundle.css',
    ];
}
