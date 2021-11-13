<?php

declare(strict_types = 1);

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\ApiController;
use app\core\Controller;

require_once __DIR__ ."/../vendor/autoload.php";


$config = [
    'userClass' => \app\models\UserModel::class,
    'db' => []
];

$app = new Application(dirname(__DIR__), $config);

$api = new ApiController();

$api->checkoutForm();