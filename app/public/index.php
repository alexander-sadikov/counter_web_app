<?php
declare(strict_types=1);

use App\Config;
use App\Controllers\CounterController;
use App\AccessMiddleware;
use App\Controllers\UserController;
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require_once '../vendor/autoload.php';

session_start();

const PUBLIC_DIR = __DIR__;
const APP_DIR = PUBLIC_DIR . '/..';
define("ENV", Config::getEnv());

$pdo = new PDO('sqlite:/usr/src/app/database/database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$container = new Container();

$container->set(PDO::class, $pdo);

AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->group('', function (RouteCollectorProxy $group) use ($app) {
    $group->group('', function (RouteCollectorProxy $group) {
        $group->get('/', [CounterController::class, 'index']);

    });
})->add(AccessMiddleware::class);

$app->get('/login_form', [UserController::class, 'loginForm']);

$app->post('/api/login', [UserController::class, 'login']);

$app->addRoutingMiddleware();
$app->run();