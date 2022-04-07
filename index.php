<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\router\Request;
use app\router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router(new Request());

$router->get('/', function() {
    return <<<HTML
  <h1>Hello world</h1>
HTML;
});