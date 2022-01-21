<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Panels;

final class InfoPanel implements PanelInterface
{
    public function getName(): string
    {
        return 'Info';
    }

    public function renderSummary(): string
    {
        return file_get_contents(dirname(__DIR__, 2) . '/resources/views/info/summary.html');
    }

    public function renderDetail(): string
    {
        return file_get_contents(dirname(__DIR__, 2) . '/resources/views/info/view.html');
    }
}
