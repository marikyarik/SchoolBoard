<?php
namespace app\entity;

class Student
{
    const table = 'student';
    private int $id;
    private string $name;
    private string $board;
    private array $grades;
    private float $averageGrade = 0;
    private bool $isPass = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBoard(): string
    {
        return $this->board;
    }

    /**
     * @param string $board
     */
    public function setBoard(string $board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @param array $grades
     */
    public function setGrades(array $grades): void
    {
        $this->grades = $grades;
        $this->setAverageGrade();
        $this->setIsPass();
    }

    /**
     * @return bool
     */
    public function isPass(): bool
    {
        return $this->isPass;
    }

    /**
     * @return float|int
     */
    public function getAverageGrade(): float|int
    {
        return $this->averageGrade;
    }

    public function setAverageGrade(): void
    {
        $this->averageGrade = 0;
        $grades = $this->getGrades();
        if(sizeof($grades) > 0) {
            if ('CSMB' === $this->getBoard() && count($grades) > 2) {
                $min = min($grades);
                $grades = array_diff($grades, [$min]);
            }
            $this->averageGrade = round(array_sum($grades) / count($grades), 2);
        }
    }

    public function setIsPass(): void
    {
        $this->isPass = false;
        if ('CSM' === $this->getBoard()) {
            $this->isPass = $this->averageGrade >= 7;
        } else if ('CSMB' === $this->getBoard()) {
            $grades = $this->getGrades();
            if (count($grades) > 2) {
                $min = min($grades);
                $grades = array_diff($grades, [$min]);
            }
            $this->isPass = max($grades) > 8;
        }
    }
}