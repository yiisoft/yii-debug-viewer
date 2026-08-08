<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

return (new Configuration())
    ->disableComposerAutoloadPathScan()
    ->setFileExtensions(['php'])
    ->addPathToScan(__DIR__ . '/config', isDev: false)
    // config/app and public are only used to run/demo this package locally (see the `yii`/`yii.bat`
    // scripts and the "yii-debug-viewer-app" config-plugin-environment), not shipped for consumers.
    ->addPathToScan(__DIR__ . '/config/app', isDev: true)
    ->addPathToScan(__DIR__ . '/public', isDev: true)
    ->addPathToScan(__DIR__ . '/resources', isDev: false)
    ->addPathToScan(__DIR__ . '/src', isDev: false)
    ->addPathToScan(__DIR__ . '/tests', isDev: true);
