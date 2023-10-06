<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class AdminController extends MasterController
{
    public function adminPage() {
        $this->view("/admin", []);
    }

    public function userModify() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $class = $_POST['class'];
        
        DB::execute(
            "UPDATE users SET name = ?, class = ? WHERE id = ?",
            [$name, $class, $id]
        );

        Lib::MsgAndGo("수정사항 적용 완료", "/admin");
        exit;
    }
}