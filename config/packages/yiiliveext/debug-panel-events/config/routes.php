<?php

declare(strict_types=1);

use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Router\Route;
use Yiiliveext\Yii\Debug\Panel\Events\PanelEventsController;

return [
    Route::get('/debug/panels/events')
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->action([PanelEventsController::class, 'view'])
        ->name('debug/panels/events'),
];
