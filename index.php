<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\router\Request;
use app\router\Router;
use app\controller\IndexController;
use app\controller\StudentController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router(new Request());

$router->get('/', [IndexController::class, 'index']);

$router->get('/students', [StudentController::class, 'list']);
$router->get('/students/:id', [StudentController::class, 'get']);
$router->post('/students/:id', [StudentController::class, 'addGrade']);