<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;

final class ToolbarAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';

    public function __construct()
    {
        $this->sourcePath = dirname(__DIR__, 2) . '/resources/assets';
    }

    public array $js = [
        'js/toolbar.js',
    ];

    public array $css = [
        'css/toolbar.css',
    ];
}