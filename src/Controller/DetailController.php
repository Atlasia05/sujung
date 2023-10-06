<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class DetailController extends MasterController
{
    public function detailPage() {
        $this->view("/detail", []);
    }

    public function detailComment() {
        $id = $_GET['id'];
        $comment = $_POST['comment'];
        $date = date("Y-m-d h:i:s", strtotime("+7 hours"));
        $u = DB::fetch("SELECT * FROM users WHERE id = ?", [user()->id]);

        DB::execute(
            "INSERT INTO comment VALUES (?,?,?,?,?,?,?)",
            [NULL, $id, $u->id, $comment, $date, $u->name, $u->image]
        );

        Lib::MsgAndBack("댓글 작성 완료");
        exit;
    }

    public function commentDel() {
        $id = $_GET['id'];

        DB::execute("DELETE FROM comment WHERE id = ?", [$id]);

        Lib::MsgAndBack("삭제 완료");
        exit;
    }
}