<?php

namespace Gondr\Controller;

use Gondr\Core\DB;
use Gondr\Core\Lib;

class UserController extends MasterController
{
    public function joinPage()
    {
        $this->view("join", []);
    }

    public function loginProcess()
    {
        if(!isset($_POST['userid']) || !isset($_POST['userpass'])){
            Lib::MsgAndBack("아이디 또는 비밀번호를 확인해주세요.");
            return;
        }
        $id = $_POST['userid'];
        $pass = $_POST['userpass'];

        $user = DB::fetch(
            "SELECT * FROM users WHERE uid = ? AND pass = ? ",
            [$id, $pass]
        );

        if($user != "") {
            $_SESSION['user'] = $user;
            Lib::MsgAndGo("로그인 성공", "/");
            exit;
        }
        else {
            Lib::MsgAndBack("아이디 또는 비밀번호를 확인해주세요.");
            exit;
        }

        Lib::MsgAndBack("오류 발생");
    }

    public function loginPage()
    {
        $this->view("login");
    }

    public function joinProcess()
    {
        if(!isset($_POST['userid']) || !isset($_POST['userpass'])){
            Lib::MsgAndBack("유저아이디나 패스워드중 공백이 있습니다.");
            return;
        }
        $id = $_POST['userid'];
        $pass = $_POST['userpass'];
        $name = $_POST['username'];

        $user = DB::fetch(
            "SELECT * FROM users WHERE uid = ?", [$id]
        );

        if($user->uid != ""){
            Lib::MsgAndBack("아이디가 이미 존재합니다.");
            return;
        }

        DB::execute(
            "INSERT INTO users VALUES (?, ?, ?, ?)", [null, $name, $id, $pass]
        );

        $_SESSION['user'] = $user;
        Lib::MsgAndGo("회원가입 완료", "/");
    }

    public function logoutProcess() {
        unset($_SESSION['user']);
        Lib::MsgAndGo("로그아웃 완료", "/");
    }
}