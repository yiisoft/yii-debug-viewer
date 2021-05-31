<?php

declare(strict_types=1);

use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Router\Route;
use Yiiliveext\Yii\Debug\Panel\Logs\PanelLogsController;

return [
    Route::get('/debug/panels/logs')
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->action([PanelLogsController::class, 'view'])
        ->name('debug/panels/logs'),
];
