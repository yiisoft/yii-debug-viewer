<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\ConfigController;
use Yiisoft\Yii\Debug\Viewer\PanelCollection;

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
            Route::get('/toolbar')->action(
                static function (
                    ResponseFactoryInterface $responseFactory,
                    PanelCollection $panelCollection
                ) {
                    $html = file_get_contents(dirname(__DIR__) . '/resources/views/toolbar.html');
                    $panels = array_map(
                        static fn (\Yiisoft\Yii\Debug\Viewer\Panels\PanelInterface $panel) => $panel->renderSummary(),
                        $panelCollection->getPanels()
                    );
                    $html = strtr($html, ['{TOOLBAR_BLOCKS}' => implode("\n", $panels)]);
                    $response = $responseFactory->createResponse()
                        ->withHeader('Content-Type', 'text/html');
                    $response->getBody()->write($html);
                    return $response;
                }
            )->name('debug/viewer/toolbar'),
            Route::get('/assets/toolbar.css')->action(static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withHeader('Content-Type', 'text/css')->withBody($streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/css/toolbar.css'));
            }),
            Route::get('/assets/toolbar.js')->action(static function (ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory) {
                return $responseFactory->createResponse()->withBody($streamFactory->createStreamFromFile(dirname(__DIR__) . '/resources/assets/js/toolbar.js'));
            })
        ),
];
