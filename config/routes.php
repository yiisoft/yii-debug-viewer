<?php

declare(strict_types=1);

use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\Middleware\DevPanelMiddleware;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;
use Yiisoft\Yii\Middleware\CorsAllowAll;

/**
 * @var array $params
 */

return [
    Group::create($params['yiisoft/yii-debug-viewer']['viewerUrl'])
        ->middleware(FormatDataResponseAsHtml::class)
        ->withCors(CorsAllowAll::class)
        ->disableMiddleware(ToolbarMiddleware::class)
        ->routes(
            Route::get('{path:.*}')
                ->middleware(FormatDataResponseAsHtml::class)
                ->middleware(DevPanelMiddleware::class)
                ->action([IndexController::class, 'index'])
                ->name('debug/index'),
        ),
];
