<?php
namespace app\controller;

use app\entity\Student;
use app\repository\StudentRepository;
use app\repository\GradeRepository;

class StudentController extends BaseController
{

    public function list()
    {
        $repository = new StudentRepository();
        $gradeRepository = new GradeRepository();
        $students = $repository->findAll();
        foreach ($students as $student) {
            $grades = $gradeRepository->findByStudent($student->getId());
            $student->setGrades($grades);
        }

        return $this->toJson($students);
    }

    public function get(int $id)
    {
        $repository = new StudentRepository();
        $gradeRepository = new GradeRepository();
        /** @var Student $student */
        $student = $repository->findOne($id);
        $grades = $gradeRepository->findByStudent($id);
        $student->setGrades($grades);
        return 'CSM' === $student->getBoard() ? $this->toJson($student) : $this->toXML($student);
    }

    /**
     * @throws \Exception
     */
    public function addGrade(int $id){
        $gradeRepository = new GradeRepository();
        $grades = $gradeRepository->findByStudent($id);
        if ((count($grades)) >= Student::MAX_GRADES) {
            throw new \Exception('Maximum number of grades per student is 4!');
        }

        $grade = $this->request->getBody()['grade'] ?? null;
        $gradeRepository->addGradeToStudent($id, $grade);
        return true;
    }
}