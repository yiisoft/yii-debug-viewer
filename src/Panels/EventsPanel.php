<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Panels;

final class EventsPanel implements PanelInterface
{
    public function getName(): string
    {
        return 'Events';
    }

    public function renderSummary(): string
    {
        return file_get_contents(dirname(__DIR__, 2) . '/resources/views/events/summary.html');
    }

    public function renderDetail(): string
    {
        return file_get_contents(dirname(__DIR__, 2) . '/resources/views/events/view.html');
    }
}
