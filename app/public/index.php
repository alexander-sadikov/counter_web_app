<?php
declare(strict_types=1);

use App\Config;
use App\Controllers\HomeController;
use App\AccessMiddleware;
use App\Controllers\UserController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require_once '../vendor/autoload.php';

session_start();

const PUBLIC_DIR = __DIR__;
const APP_DIR = PUBLIC_DIR . '/..';
define("ENV", Config::getEnv());

$app = AppFactory::create();

$app->group('', function (RouteCollectorProxy $group) use ($app) {
    $group->group('', function (RouteCollectorProxy $group) {
        $group->get('/', [HomeController::class, 'index']);

    });
})->add(AccessMiddleware::class);

$app->get('/login_form', [UserController::class, 'login_form']);
$app->get('/login', [UserController::class, 'login']);

$app->addRoutingMiddleware();
$app->run();