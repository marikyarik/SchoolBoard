<?php
namespace app\repository;

use app\entity\Student;

class StudentRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Student::class);
    }
}