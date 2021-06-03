<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Panels;

final class PanelCollection
{
    private array $panels;

    /**
     * PanelCollection constructor.
     */
    public function __construct(array $panels)
    {
        $this->panels = $panels;
    }

    public function addPanel(string $name, array $config, bool $override = false): void
    {
        if (!$override && isset($this->panels[$name])) {
            throw new \RuntimeException('Panel already exists.');
        }

        $this->panels[$name] = $config;
    }

    public function getPanels(): array
    {
        return $this->panels;
    }
}
