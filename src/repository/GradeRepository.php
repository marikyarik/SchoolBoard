<?php
namespace app\repository;

use app\entity\Grade;

class GradeRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Grade::class);
    }

    public function findByStudent(int $id)
    {
        $table = $this->class::table;
        $stmt = $this->connection->query("SELECT grade FROM {$table} where student_id = {$id}");

        $data = [];
        while ($item = $stmt->fetch()) {
            $data[] = $item['grade'];
        }
        $stmt->closeCursor();

        return $data;
    }
}