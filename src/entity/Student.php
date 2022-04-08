<?php
namespace app\entity;

class Student
{
    const table = 'student';
    private int $id;
    private string $name;
    private string $board;

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
}