<?php

declare(strict_types = 1);

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\ApiController;
use app\controllers\customer\CustomerController;

require_once __DIR__ ."/../vendor/autoload.php";


$config = [
    'userClass' => \app\models\UserModel::class,
    'db' => []
];

$app = new Application(dirname(__DIR__), $config);

// api requests
$app->router->get("/api", [ApiController::class, 'type']);
$app->router->post("/api/create", [ApiController::class, 'post']);
$app->router->post("/api/update", [ApiController::class, 'update']);
$app->router->post("/api/addDiff", [ApiController::class, 'addDiff']);
$app->router->post("/api/delete", [ApiController::class, 'delete']);
$app->router->get("/api/delivery", [ApiController::class, 'checkoutForm']);
$app->router->get("/api/render", [ApiController::class, 'renderForm']);

$app->router->get("/", [SiteController::class, 'index']);
$app->router->get("/index", [SiteController::class, 'index']);
$app->router->get("/home", [SiteController::class, 'index']);

$app->router->get("/dashboard", [SiteController::class, 'dashboard']);

$app->router->get("/captcha", [SiteController::class, 'captcha']);

$app->router->get("/cart", [SiteController::class, 'cart']);
$app->router->get("/about", [SiteController::class, 'about']);

$app->router->get("/order", [SiteController::class, 'order']);
$app->router->get("/checkout", [SiteController::class, 'checkout']);
$app->router->get("/edit", [SiteController::class, 'editProduct']);
$app->router->get("/order_success", [SiteController::class, 'order_success']);

$app->router->get("/login", [AuthController::class, 'login']);
$app->router->post("/login", [AuthController::class, 'login']);

$app->router->get("/register", [AuthController::class, 'register']);
$app->router->post("/register", [AuthController::class, 'register']);

$app->router->post("/logout", [AuthController::class, 'logout']);

$app->router->post("/place-order", [SiteController::class, 'place_order']);


$app->router->get("/my-account", [CustomerController::class, 'my_account']);
$app->router->get("/my-account/orders", [CustomerController::class, 'orders']);
$app->router->get("/my-account/view-order/:id", [CustomerController::class, 'view_order']);
$app->router->get("/my-account/edit-account", [CustomerController::class, 'editAccount']);




// $app->router->get("/order/{$type}/{$name}", [SiteController::class, 'viewProduct']);
$app->run();

