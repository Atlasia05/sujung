<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class ModifyController extends MasterController
{
    public function modifyPage()
    {
        $this->view("modify", []);
    }

    public function modifyProcess() {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $comment = trim($_POST['comment']);
        $price = trim($_POST['price']);
        $no_image = $_POST['no_img'];
        $file = $_FILES['chooseFile'];

        if($title == "" || $comment == "" || $price == "") {
            Lib::MsgAndBack("공백을 입력할 순 없습니다.");
            exit;
        }

        if(strlen($price) >= 12) {
            Lib::MsgAndBack("10억 이상은 입력할 순 없습니다.");
            exit;
        }

        if($file['size'] > 1500000) {
            Lib::MsgAndBack("이미지 사이즈가 너무 큽니다.");
            exit;
        }

        DB::execute(
            "UPDATE boards SET title = ?, comment = ?, price = ? WHERE id = ?",
            [$title, $comment, $price, $id]
        );


        if($no_image == "true") {
            DB::execute(
                "UPDATE boards SET image = ? WHERE id = ?", [NULL, $id]
            );
            var_dump($id);
            Lib::MsgAndGo("수정 완료", "/detail?id=$id");
            exit;
        }

        else {
            if($file['name'] != "") {
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
                        "UPDATE boards SET image = ? WHERE id = ?",
                            [$location . "/" . $realName, $id]
                    );
                    Lib::MsgAndGo("수정 완료", "/detail?id=$id");
                    exit;
                }
                else {;
                    Lib::MsgAndBack("이미지는 jpeg, jpg, gif, png 파일만 가능합니다.");
                    exit;
                }
            }
            else {
                Lib::MsgAndGo("수정 완료", "/detail?id=$id");
                exit;
            }
        }
    }

    public static function deleteProcess() {
        $id = $_GET['id'];
        DB::execute("DELETE FROM boards WHERE id = ?", [$id]);
        Lib::MsgAndGo("삭제 완료", "/");
        exit;
    }
}