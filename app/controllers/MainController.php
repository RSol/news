<?php

namespace app\controllers;

use app\sys\Controller;

class MainController extends Controller
{
    public function index()
    {
        return $this->render('index');
    }
}
