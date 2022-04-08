<?php
namespace app\controller;

use app\repository\StudentRepository;

class StudentController
{

    private StudentRepository $repository;

    public function __construct()
    {
        $this->repository = new StudentRepository();
    }

    public function list()
    {
        var_dump($this->repository->findAll());
    }

    public function get(int $id)
    {
        var_dump($this->repository->findOne($id));
    }
}