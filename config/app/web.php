<?php

use Yiisoft\Yii\Debug\Viewer\NotFoundHandler;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Injector\Injector;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Definitions\Reference;
use Yiisoft\Definitions\DynamicReference;
use HttpSoft\Message\RequestFactory;
use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\ServerRequestFactory;
use HttpSoft\Message\StreamFactory;
use HttpSoft\Message\UploadedFileFactory;
use HttpSoft\Message\UriFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Request\Body\RequestBodyParser;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;

return [
    Yiisoft\Yii\Web\Application::class => [
        '__construct()' => [
            'dispatcher' => DynamicReference::to(static function (Injector $injector) {
                return ($injector->make(MiddlewareDispatcher::class))
                    ->withMiddlewares(
                        [
                            Router::class,
                            SubFolder::class,
                            ErrorCatcher::class,
                        ]
                    );
            }),
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],
    RequestFactoryInterface::class => RequestFactory::class,
    ServerRequestFactoryInterface::class => ServerRequestFactory::class,
    ResponseFactoryInterface::class => ResponseFactory::class,
    StreamFactoryInterface::class => StreamFactory::class,
    UriFactoryInterface::class => UriFactory::class,
    UploadedFileFactoryInterface::class => UploadedFileFactory::class,
    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) use ($config) {
        //$routes = array_merge($config->get('routes'), require 'routes.php');
        $collector
            ->middleware(FormatDataResponse::class)
            ->addGroup(Group::create()->routes(...$config->get('routes')));

        return new RouteCollection($collector);
    },

];
