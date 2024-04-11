<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\View\WebView;

final class DevPanelAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [];
    public array $css = [];

    public function __construct(string $staticUrl, bool $registerServiceWorker)
    {
        $this->js[] = [$staticUrl . '/bundle.js', WebView::POSITION_END, 'type' => 'module'];

        if ($registerServiceWorker) {
            $this->js[] = $staticUrl . '/registerSW.js';
        }

        $this->css[] = $staticUrl . '/bundle.css';
    }
}
