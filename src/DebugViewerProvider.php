<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Debug\Viewer;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\ServiceProviderInterface;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

final class DebugViewerProvider implements ServiceProviderInterface
{
    /**
     * @psalm-suppress InaccessibleMethod
     */
    public function getDefinitions(): array
    {
        return [];
    }

    #[ArrayShape([RouteCollectorInterface::class => \Closure::class])]
    public function getExtensions(): array
    {
        return [
            RouteCollectorInterface::class => static function (ContainerInterface $container, RouteCollectorInterface $routeCollector) {
                $routeCollector->prependMiddleware(ToolbarMiddleware::class);
                return $routeCollector;
            },
        ];
    }
}
