<?php

header('Content-Type: application/json');

@mkdir('/tmp/framework/cache', 0777, true);
@mkdir('/tmp/framework/sessions', 0777, true);
@mkdir('/tmp/framework/views', 0777, true);
@mkdir('/tmp/storage/logs', 0777, true);

$checks = [
    'php_version' => PHP_VERSION,
    'vendor_autoload_exists' => file_exists(__DIR__.'/../vendor/autoload.php'),
    'app_key_is_set' => getenv('APP_KEY') !== false && getenv('APP_KEY') !== '',
    'app_debug' => getenv('APP_DEBUG') ?: null,
    'vercel_env' => getenv('VERCEL_ENV') ?: null,
    'tmp_is_writable' => is_writable('/tmp'),
    'tmp_framework_views_exists' => is_dir('/tmp/framework/views'),
    'tmp_framework_views_writable' => is_dir('/tmp/framework/views') && is_writable('/tmp/framework/views'),
    'public_build_manifest_exists' => file_exists(__DIR__.'/../public/build/manifest.json'),
];

echo json_encode($checks, JSON_PRETTY_PRINT);
