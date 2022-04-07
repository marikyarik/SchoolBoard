<?php
namespace app\database;

class Db
{
    private static ?Db $instance = null;
    private \PDO $conn;

    private function __construct()
    {
        $uri = $_ENV['DB_URI'];
        $this->conn = new \PDO("sqlite:" . $uri);
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}