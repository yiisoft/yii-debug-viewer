<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Factory;

use Psr\Container\ContainerInterface;
use Yiisoft\Yii\Debug\Viewer\PanelCollection;

class PanelCollectionFactory
{
    public function __construct(private array $panels)
    {
    }

    public function __invoke(ContainerInterface $container): PanelCollection
    {
        $panels = [];
        foreach ($this->panels as $id => $panel) {
            if (is_string($panel)) {
                $panel = $container->get($panel);
            }
            $panels[$id] = $panel;
        }

        return new PanelCollection($panels);
    }
}