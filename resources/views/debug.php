<?php

use Yiisoft\Assets\AssetManager;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Debug\Viewer\Asset\DevPanelAsset;

/**
 * @var WebView $this
 * @var AssetManager $assetManager
 */

$assetManager->register(DevPanelAsset::class);

$this->addCssFiles($assetManager->getCssFiles());
$this->addCssStrings($assetManager->getCssStrings());
$this->addJsFiles($assetManager->getJsFiles());
$this->addJsStrings($assetManager->getJsStrings());
$this->addJsVars($assetManager->getJsVars());

$this->beginPage();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <meta name="description" content="Aggregator for Yii3 specific frontends"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
        <link rel="icon" href="https://yiisoft.github.io/yii-dev-panel/favicon.ico"/>
        <link rel="icon" type="image/png" sizes="32x32"
              href="https://yiisoft.github.io/yii-dev-panel/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16"
              href="https://yiisoft.github.io/yii-dev-panel/favicon-16x16.png">
        <link rel="apple-touch-icon" sizes="192x192"
              href="https://yiisoft.github.io/yii-dev-panel/android-chrome-192x192.png">
        <link rel="apple-touch-startup-image" sizes="512x512"
              href="https://yiisoft.github.io/yii-dev-panel/android-chrome-512x512.png"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Yii Dev Panel">
        <meta name="application-name" content="Yii Dev Panel">
        <meta name="msapplication-TileColor" content="#01617b">
        <meta name="theme-color" content="#01617b">
        <link rel="manifest" href="https://yiisoft.github.io/yii-dev-panel/manifest.json"/>
        <title>Yii Dev Panel</title>
        <?php $this->head() ?>
    </head>
    <body style="display:flex;flex-direction:column;min-height:100vh;justify-content:space-between">
    <?php
    $this->beginBody() ?>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root" style="flex:1"></div>
    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage();
