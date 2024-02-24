<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Yii\View\ViewRenderer;

final class IndexController
{
    public function index(ViewRenderer $viewRenderer): ResponseInterface
    {
        return $viewRenderer
            ->withLayout(null)
            ->withViewPath('@vendor/yiisoft/yii-debug-viewer/resources/views')
            ->renderPartial('debug.php');
    }
}
