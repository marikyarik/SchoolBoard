<?php
namespace app\controller;

use app\entity\Student;
use app\repository\StudentRepository;
use app\repository\GradeRepository;

class StudentController extends BaseController
{

    private StudentRepository $repository;
    private GradeRepository $gradeRepository;

    public function __construct()
    {
        $this->repository = new StudentRepository();
        $this->gradeRepository = new GradeRepository();
    }

    public function list()
    {
        $students = $this->repository->findAll();
        foreach ($students as $student) {
            $grades = $this->gradeRepository->findByStudent($student->getId());
            $student->setGrades($grades);
        }

        return $this->toJson($students);
    }

    public function get(int $id)
    {
        /** @var Student $student */
        $student = $this->repository->findOne($id);
        $grades = $this->gradeRepository->findByStudent($id);
        $student->setGrades($grades);
        return 'CSM' === $student->getBoard() ? $this->toJson($student) : $this->toXML($student);
    }
}