<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class MypageController extends MasterController
{
    public function myPage()
    {
        $this->view("my-page", []);
    }

    public function myPageProcess() {
        $uname = $_POST['name'];
        $file = $_FILES['profile'];
        $noImage = $_POST['noImage'];

        if($file['name'] != "") {
            if($file['size'] > 1500000) {
                Lib::MsgAndBack("파일 사이즈가 너무 큽니다.");
            }
            $type = explode("/", $file['type'])[1];
            if($type == "gif" || $type == "jpeg" || $type == "jpg" || $type == "png") {
                $realName = $file['name'];
                $location = "images/" . $_SESSION['user']->uid;
                $name = $file['tmp_name'];
                if (!file_exists($location)) {
                    mkdir($location, 0777, true);
                }
                move_uploaded_file($name, $location . "/" . $realName);
                DB::execute(
                    "UPDATE users SET image = ?, name = ? WHERE id = ?",
                    [$location . "/" . $realName, $uname, $_SESSION['user']->id]
                );
                DB::execute(
                    "UPDATE comment SET uimage = ? WHERE uid = ?",
                    [$location . "/" . $realName, $_SESSION['user']->id]
                );
                Lib::MsgAndGo("변경 완료", "/my-page");
                exit;
            }
            else {;
                Lib::MsgAndBack("이미지는 jpeg, jpg, gif, png 파일만 가능합니다.");
                exit;
            }
        }
        else {
            if($noImage != "") {
                DB::execute(
                    "UPDATE users SET name = ?, image = ? WHERE id = ?",
                    [ $uname, "images/static/user.jpg", $_SESSION['user']->id]
                );
                DB::execute(
                    "UPDATE comment SET uimage = ? WHERE uid = ?",
                    ["images/static/user.jpg", $_SESSION['user']->id]
                );
                Lib::MsgAndGo("변경 완료", "/my-page");
            }
            else {
                DB::execute(
                    "UPDATE users SET name = ? WHERE id = ?",
                    [ $uname, $_SESSION['user']->id]
                );
                Lib::MsgAndGo("변경 완료", "/my-page");
            }
        }
    }
}