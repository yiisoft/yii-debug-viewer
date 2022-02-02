<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use Yiisoft\Yii\Debug\Viewer\Panels\PanelInterface;

final class PanelCollection
{
    /**
     * @var array<string, PanelInterface>
     */
    private array $panels;

    /**
     * PanelCollection constructor.
     */
    public function __construct(array $panels)
    {
        $this->validatePanels($panels);
        $this->panels = $panels;
    }

    public function addPanel(string $id, PanelInterface $panel, bool $override = false): void
    {
        if (!$override && isset($this->panels[$id])) {
            throw new \RuntimeException('Panel already exists.');
        }

        $this->panels[$id] = $panel;
    }

    public function getPanel(string $id): PanelInterface
    {
        if (!isset($this->panels[$id])) {
            throw new \InvalidArgumentException(sprintf('Panel "%s" doesn\'t exist.', $id));
        }
        return $this->panels[$id];
    }

    /**
     * @return array<string, PanelInterface>
     */
    public function getPanels(): array
    {
        return $this->panels;
    }

    private function validatePanels(array $panels): void
    {
        foreach ($panels as $panel) {
            if (!($panel instanceof PanelInterface)) {
                throw new \RuntimeException(
                    sprintf('Panel must implement PanelInterface. Got: %s.', get_debug_type($panel))
                );
            }
        }
    }
}
