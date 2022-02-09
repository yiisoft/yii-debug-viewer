<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\PanelCollection;

$panels = array_keys($params['yiisoft/yii-debug-viewer']['panels']);

return [
    Group::create($params['yiisoft/yii-debug-viewer']['viewerUrl'])
        ->middleware(FormatDataResponseAsHtml::class)
        ->withCors(CorsMiddleware::class)
        ->routes(
            Route::get('[/[{panel:' . implode('|', $panels) . '}]]')
                ->middleware(FormatDataResponseAsHtml::class)
                ->action([IndexController::class, 'index'])
                ->name('debug/panels/index'),
            Route::get('/config')
                ->middleware(FormatDataResponseAsJson::class)
                ->action(
                    static function (
                        PanelCollection $panelCollection,
                        DataResponseFactoryInterface $responseFactory
                    ) use ($params) {
                        $params = $params['yiisoft/yii-debug-viewer'];
                        $config = [
                            'baseUrl' => $params['baseUrl'],
                            'viewerUrl' => $params['viewerUrl'],
                            'panels' => [],
                        ];
                        foreach ($panelCollection->getPanels() as $id => $panel) {
                            $config['panels'][$id] = $panel->getName();
                        }
                        return $responseFactory->createResponse($config);
                    }
                )
                ->name('debug/panels/config'),
            Route::get('/panels/{panel}')
                ->action([IndexController::class, 'panel'])
                ->name('debug/panels/panel'),
            Route::get('/toolbar')->action([IndexController::class, 'toolbar'])->name('debug/viewer/toolbar'),
        ),
    Group::create($params['yiisoft/yii-debug-viewer']['baseUrl'])->routes(
        Route::get('/assets/toolbar.css')->action(
            static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withHeader('Content-Type', 'text/css')->withBody(
                    $streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/css/toolbar.css')
                );
            }
        )->name('debug/toolbar/css'),
        Route::get('/assets/toolbar.js')->action(
            static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withBody(
                    $streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/js/toolbar.js')
                );
            }
        )->name('debug/toolbar/js')
    ),
];
