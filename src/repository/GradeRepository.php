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

    public function addGradeToStudent(int $id, int $grade) {
        $table = $this->class::table;
        $query = $this->connection->prepare("INSERT INTO {$table} (student_id, grade) VALUES(?, ?)");
        $query->execute(array($id, $grade));
    }
}