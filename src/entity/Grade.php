<?php

namespace app\entity;

class Grade
{
    const table = 'grade';
    private int $studentId;
    private int $grade;

    /**
     * @return int
     */
    public function getGrade(): int
    {
        return $this->grade;
    }

    /**
     * @param int $grade
     */
    public function setGrade(int $grade): void
    {
        $this->grade = $grade;
    }

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * @param int $studentId
     */
    public function setStudentId(int $studentId): void
    {
        $this->studentId = $studentId;
    }
}