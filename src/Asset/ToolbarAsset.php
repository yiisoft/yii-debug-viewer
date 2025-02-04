<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Assets\AssetManager;
use Yiisoft\View\WebView;

/**
 * @psalm-import-type CssFile from AssetManager
 * @psalm-import-type JsFile from AssetManager
 */
final class ToolbarAsset extends AssetBundle
{
    public bool $cdn = true;

    /**
     * @psalm-var array<array-key, string|JsFile>
     */
    public array $js = [
        ['/bundle.js', WebView::POSITION_END, 'type' => 'module'],
    ];

    /**
     * @psalm-var array<array-key, string|CssFile>
     */
    public array $css = [
        '/bundle.css',
    ];
}
