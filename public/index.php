<?php

declare(strict_types = 1);

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\ApiController;


require_once __DIR__ ."/../vendor/autoload.php";


$config = [
    'userClass' => \app\models\UserModel::class,
    'db' => []
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get("/api", [ApiController::class, 'type']);

$app->router->get("/", [SiteController::class, 'index']);
$app->router->get("/index", [SiteController::class, 'index']);
$app->router->get("/home", [SiteController::class, 'index']);

$app->router->get("/order", [SiteController::class, 'order']);

// $app->router->get("/order/{$type}/{$name}", [SiteController::class, 'viewProduct']);

$app->router->get("/edit-profile", [SiteController::class, 'edit']);
$app->router->post("/edit-profile", [SiteController::class, 'edit']);

$app->router->get("/view-profile", [SiteController::class, 'profile']);

$app->router->get("/questionaire", [SiteController::class, 'questionaire']);
$app->router->post("/questionaire", [SiteController::class, 'questionaire']);

$app->router->get("/mismatch", [SiteController::class, 'mismatch']);
$app->router->get("/account", [SiteController::class, 'account']);


$app->router->get("/login", [AuthController::class, 'login']);
$app->router->post("/login", [AuthController::class, 'login']);

$app->router->get("/register", [AuthController::class, 'register']);
$app->router->post("/register", [AuthController::class, 'register']);

$app->router->post("/logout", [AuthController::class, 'logout']);

$app->run();
