<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\database\Db;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

file_put_contents($_ENV['DB_URI'], "");

$connection = Db::getInstance()->getConnection();
$files = glob('migrations/*.sql');
foreach($files as $file) {
    $commands = file_get_contents($file);
    $commands = explode(';', $commands);
    foreach($commands as $command) {
        if(strlen($command) > 0) {
            $connection->exec($command);
        }
    }
}