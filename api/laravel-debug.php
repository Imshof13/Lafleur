<?php

use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;

header('Content-Type: application/json');

@mkdir('/tmp/framework/cache', 0777, true);
@mkdir('/tmp/framework/sessions', 0777, true);
@mkdir('/tmp/framework/views', 0777, true);
@mkdir('/tmp/storage/logs', 0777, true);

try {
    require __DIR__.'/../vendor/autoload.php';

    $app = require __DIR__.'/../bootstrap/app.php';
    $app->register(ViewServiceProvider::class);

    ob_start();
    $app->handleRequest(Request::create('/up', 'GET'));
    $body = ob_get_clean();

    echo json_encode([
        'ok' => true,
        'message' => 'Laravel handled /up without throwing.',
        'body_preview' => substr($body, 0, 500),
    ], JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    http_response_code(500);

    echo json_encode([
        'ok' => false,
        'type' => get_class($e),
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 12),
    ], JSON_PRETTY_PRINT);
}
