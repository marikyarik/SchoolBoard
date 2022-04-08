<?php
namespace app\repository;

use app\entity\Grade;

class GradeRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Grade::class);
    }
}