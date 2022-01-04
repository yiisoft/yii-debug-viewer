<?php

declare(strict_types=1);

use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @psalm-var string $_SERVER['REQUEST_URI']
 */

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    /** @psalm-suppress MixedArgument */
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

// Run HTTP application runner
$runner = new HttpApplicationRunner(dirname(__DIR__), true, 'yii-debug-viewer-app');
$runner->run();
