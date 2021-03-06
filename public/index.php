<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Service\Environment;
use App\Service\Router;
use App\Service\Http\Request;

$environment = new Environment();

if ($environment->get("APP_ENV") === 'dev') {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
}

$request = new Request();

$router = new Router();;

$response = $router->run($request->server()->get('REQUEST_URI'),$request->server()->get('REQUEST_METHOD'));
$response->send();
