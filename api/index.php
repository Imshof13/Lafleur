<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\ViewServiceProvider;

define('LARAVEL_START', microtime(true));

@mkdir('/tmp/framework/cache', 0777, true);
@mkdir('/tmp/framework/sessions', 0777, true);
@mkdir('/tmp/framework/views', 0777, true);
@mkdir('/tmp/storage/logs', 0777, true);

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->register(ViewServiceProvider::class);

Facade::setFacadeApplication($app);
$app->handleRequest(Request::capture());
