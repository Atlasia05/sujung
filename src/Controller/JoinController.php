<?php

namespace Art\Controller;

use Art\Core\DB;
use Art\Core\Lib;

class JoinController extends MainController
{
    public function joinPage() {
        $this->view("/join", []);
    }

    public function checkProcess() {
        $this->view("/check", []);
    }

    public function joinProcess() {
        $name = trim($_POST['name']);
        $uid = trim($_POST['uid']);
        $phone = trim($_POST['phone']);
        $class = trim($_POST['class']);
        $pass1 = trim($_POST['pass1']);
        $pass2 = trim($_POST['pass2']);
        $check = "/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i";

        if(preg_match($check, $uid)) {
            Lib::MsgAndBack("아이디에 특수문자를 포함할 수 없습니다.");
            exit;
        }

        if($pass1 != $pass2) {
            Lib::MsgAndBack("비밀번호를 다시 확인해주세요.");
            exit;
        }

        if(strlen($phone) != 13) {
            Lib::MsgAndBack("전화번호가 형식에 맞지 않습니다.");
            exit;
        }

        if(trim($name) == "" || trim($pass1) == "") {
            Lib::MsgAndBack("이름,비밀번호는 공백일 수 없습니다.");
            exit;
        }

        $user = DB::fetch("SELECT * FROM users WHERE phone = ?", [$phone]);
        if($user != "") {
            Lib::MsgAndBack("중복된 전화번호 입니다.");
            exit;
        }

        $user = DB::fetch("SELECT * FROM users WHERE class = ?", [$class]);
        if($user != "") {
            Lib::MsgAndBack("중복된 학번 입니다.");
            exit;
        }

        DB::execute(
            "INSERT INTO users VALUES (?,?,?,?,?,?,?)",
            [NULL,$name,$phone,$class,$uid,$pass1,"images/static/user.jpg"]
        );

        $user = DB::fetch(
            "SELECT * FROM users WHERE uid = ? AND pass = ?",
            [$uid, $pass1]
        );

        $_SESSION['user'] = $user;

        Lib::MsgAndGo("회원가입 완료", "/");
        exit;
    }

    public function loginProcess() {
        $uid = $_POST['uid'];
        $pass = $_POST['pass'];

        $user = DB::fetch(
        "SELECT * FROM users WHERE uid = ? AND pass = ?",
            [$uid,$pass]
        );

        if($user != "") {
            $_SESSION['user'] = $user;
            Lib::MsgAndGo("로그인 성공", "/");
            exit;
        }
        else {
            Lib::MsgAndBack("정보가 없는 사용자입니다.");
            exit;
        }
    }

    public function logoutProcess() {
        unset($_SESSION['user']);
        Lib::MsgAndGo("로그아웃 완료", "/");
        exit;
    }
}