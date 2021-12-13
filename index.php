<?php

use app\src\controllers\AuthController;
use app\src\controllers\UserController;
use app\core\Application;
use app\src\models\User;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(__DIR__, $config);



$app->router->get('/', [AuthController::class, 'home']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->router->get('/users', [UserController::class, 'list']);
$app->router->get("/users/detail",[UserController::class, 'detail']);
$app->router->get("/users/update",[UserController::class, 'update']);
$app->router->post("/users/update",[UserController::class, 'update']);
$app->router->get("/users/delete",[UserController::class, 'delete']);

$app->run();