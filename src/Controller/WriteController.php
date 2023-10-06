<?php

namespace Gondr\Controller;
use Gondr\Core\Lib;
use Gondr\Core\DB;

class WriteController extends MasterController
{
    public function writePage() {
        $this->view("write", []);
    }

    public function writeProcess() {
        if(isset($_POST['title'])) {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $comment = $_POST['comment'];

            if(trim($title) == "" || trim($comment) == "") {
                Lib::MsgAndBack("제목과 내용이 공백일수 없습니다.");
                exit;
            }
            $user = $_SESSION['user'];

            DB::execute(
                "INSERT INTO boards VALUES (?,?,?,?,?,?)",
                [null, $user->uid, $category, $title, $comment, ""]
            );
        }
        else {
            var_dump("ERROR");
            Lib::MsgAndBack("애러 발생", "/");
            exit;
        }

        $upi = $_FILES['upimg'];
        if($upi != "") {
            $realName = $upi['name'];
            $tmpName = $upi['tmp_name'];
            $type = $upi['type'];
            $path = __ROOT . "/data/" . $realName;
            $id = DB::lastId();
            if(explode("/", $type)[0] != "image") {
                Lib::MsgAndBack("이미지파일만 업로드 가능합니다.");
                exit;
            }
            DB::execute(
                "UPDATE boards SET image = ? WHERE id = ?", [$path, $id]
            );
            move_uploaded_file($tmpName, $path);

            Lib::MsgAndGo("업로드 완료", "/");
        }
        else {
            Lib::MsgAndGo("업로드 완료", "/");
            exit;
        }
    }
}
