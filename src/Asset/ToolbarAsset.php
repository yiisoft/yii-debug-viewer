<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

final class ToolbarAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [];
    public array $css = [];

    public function __construct(string $staticUrl)
    {
        $this->js[] = [$staticUrl . '/bundle.js', WebView::POSITION_END, 'type' => 'module'];

        $this->css[] = $staticUrl . '/bundle.css';
    }
}
