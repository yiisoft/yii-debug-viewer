<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer\Panels;

interface PanelInterface
{
    public function getName(): string;

    public function renderSummary(): string;

    public function renderDetail(): string;
}
