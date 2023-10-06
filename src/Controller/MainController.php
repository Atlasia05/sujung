<?php

namespace Art\Controller;

use Art\Core\DB;

class MainController extends MasterController
{
    public function index()
    {
        $this->view("main", []);
    }
}