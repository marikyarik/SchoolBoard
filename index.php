<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\router\Request;
use app\router\Router;

$router = new Router(new Request());

$router->get('/', function() {
    return <<<HTML
  <h1>Hello world</h1>
HTML;
});