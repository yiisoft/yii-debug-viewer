<?php

declare(strict_types=1);

use Yiisoft\Router\Route;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Yii\Debug\Viewer\IndexController;

return [
    Route::get('[/]')
        ->middleware(FormatDataResponseAsHtml::class)
        ->action([IndexController::class, 'index'])
        ->name('site/index'),
];
