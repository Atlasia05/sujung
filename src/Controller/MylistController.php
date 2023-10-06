<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class MylistController extends MasterController
{
    public function mylistPage()
    {
        $this->view("my-list", []);
    }

    public function mylistProcess()
    {
        $status = $_POST['status'];
        $id = $_POST['id'];

        DB::execute(
            "UPDATE boards SET status = ? WHERE id = ?",
            [$status, $id]
        );

        Lib::MsgAndBack("저장 완료");
        exit;
    }
}