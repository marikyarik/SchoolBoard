<?php

namespace app\repository;

use app\database\Db;

class Repository
{
    protected \PDO $connection;
    protected string $class;

    public function __construct(string $class)
    {
        $this->connection = Db::getInstance()->getConnection();
        $this->class = $class;
    }

    public function findAll(): array
    {
        $table = $this->class::table;
        $stmt = $this->connection->query("SELECT * FROM {$table}");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->class);

        $data = [];
        while ($item = $stmt->fetch()) {
            $data[] = $item;
        }
        $stmt->closeCursor();

        return $data;
    }

    public function findOne(int $id): object
    {
        $table = $this->class::table;
        $stmt = $this->connection->query("SELECT * FROM {$table} WHERE id = {$id}");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->class);

        return $stmt->fetch();
    }
}