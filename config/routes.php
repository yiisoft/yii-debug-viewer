<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\ConfigController;
use Yiisoft\Yii\Debug\Viewer\IndexController;

return [
    Route::get('/debug/viewer[/]')
        ->middleware(FormatDataResponseAsHtml::class)
        ->action([IndexController::class, 'index'])
        ->name('debug/panels/index'),
    Group::create($params['yiisoft/yii-debug-viewer']['baseUrl'])
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->routes(
            Route::get('/config')
                ->middleware(FormatDataResponseAsJson::class)
                ->action([ConfigController::class, 'index'])
                ->name('debug/panels/config'),
            Route::get('/panels/{panel}')
                ->action([IndexController::class, 'panel'])
                ->name('debug/panels/panel'),
            Route::get('/toolbar')->action([IndexController::class, 'toolbar'])->name('debug/viewer/toolbar'),
            Route::get('/assets/toolbar.css')->action(static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withHeader('Content-Type', 'text/css')->withBody($streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/css/toolbar.css'));
            }),
            Route::get('/assets/toolbar.js')->action(static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withBody($streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/js/toolbar.js'));
            })
        ),
];
