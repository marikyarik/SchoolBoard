<?php
namespace app\controller;

class IndexController extends BaseController
{
    public function index()
    {
        echo $this->template->render('home.php');
    }
}