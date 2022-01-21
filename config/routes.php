<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\ConfigController;

return [
    Route::get('/debug/viewer[/]')
        ->middleware(FormatDataResponseAsHtml::class)
        ->action([IndexController::class, 'index'])
        ->name('debug/panels/index'),
    Group::create('/debug/panels')
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->routes(
            Route::get('/config')
                ->middleware(FormatDataResponseAsJson::class)
                ->action([ConfigController::class, 'index'])
                ->name('debug/panels/config'),
            Route::get('/{panel}')
                ->action([IndexController::class, 'panel'])
                ->name('debug/panels/panel'),
        ),
    Route::get($params['yiisoft/yii-debug-viewer']['toolbarUrl'])->action(
        static function (
            ResponseFactoryInterface $responseFactory,
            \Yiisoft\Yii\Debug\Viewer\PanelCollection $panelCollection
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
];
