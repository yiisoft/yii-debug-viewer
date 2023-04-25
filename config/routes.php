<?php

declare(strict_types=1);

use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\Middleware\Cors;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/**
 * @var array $params
 */

return [
    Group::create($params['yiisoft/yii-debug-viewer']['viewerUrl'])
        ->middleware(FormatDataResponseAsHtml::class)
        ->withCors(Cors::class)
        ->disableMiddleware(ToolbarMiddleware::class)
        ->routes(
            Route::get('[/]')
                ->middleware(FormatDataResponseAsHtml::class)
                ->action([IndexController::class, 'index'])
                ->name('debug/index'),
        ),
];
