<?php

declare(strict_types=1);

use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Router\Route;
use Yiiliveext\Yii\Debug\Panel\Services\PanelServicesController;

return [
    Route::get('/debug/panels/services')
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->action([PanelServicesController::class, 'view'])
        ->name('debug/panels/services'),
];
