<?php

namespace Gondr\Controller;

use Gondr\Core\Lib;

class FileController extends MasterController
{
    public function uploadPage()
    {
        $this->view("upload");
    }

    public function uploadProcess()
    {
        $tmpName = $_FILES["upload"]["tmp_name"];
        $realName = $_FILES["upload"]["name"];

        $user = user();
        $filePath = __DATA . "/" . $user->userid;
        if (!file_exists($filePath)) {
            mkdir($filePath);
        }

        move_uploaded_file($tmpName, $filePath . "/" . $realName);
        Lib::MsgAndGo("업로드 성공", "/list");
    }

    public function listPage()
    {
        $path = __DATA . "/" . user()->userid;
        if (!file_exists($path)) {
            mkdir($path);
        }

        $fileList = scandir($path, SCANDIR_SORT_ASCENDING);
        array_splice($fileList, 0, 2);
        //var_dump(json_encode( $fileList, JSON_UNESCAPED_UNICODE));

        $this->view("list", ['list' => $fileList]);
    }

    public function download()
    {
        if (!isset($_GET['user']) || !isset($_GET['name'])) {
            Lib::MsgAndBack("잘못된 접근입니다");
            return;
        }

        $user = $_GET['user'];
        $name = urldecode($_GET['name']);

        if (!$this->checkAuth($user, $name)) {
            Lib::MsgAndBack("해당 파일에 접근할 권한이 없습니다.");
            return;
        }

        $this->downloadFile(__DATA . "/" . $user . "/" . $name, $name);
    }

    private function checkAuth($user, $name): bool
    {
        //2018 공유체크
        return $user == user()->userid;
    }

    private function downloadFile($filePath, $name)
    {
        if (!file_exists($filePath)) {
            Lib::MsgAndBack("존재하지 않는 파일입니다");
            return;
        }

        $fileSize = filesize($filePath);

        header("Pragma: public");  //생략 가능
        header("Content-Type: application/octet-stream"); //생략가능
        header("Content-Disposition: attachment; filename=$name");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: $fileSize"); //생략가능

        ob_clean();
        flush();
        readfile($filePath); //파일에 있는 내용을 전부 긁어와서 출력
        exit;
    }

    public function delete()
    {
        $name = urldecode($_GET['name']);

        $user = user();
        $filePath = __DATA . "/" . $user->userid . "/" . $name;
        $json = "";
        if (!file_exists($filePath)) {
            $json = json_encode(['result' => false, 'msg' => '존재하지 않는 파일입니다.' . $name], JSON_UNESCAPED_UNICODE);
        } else {
            if (unlink($filePath)) {
                $json = json_encode(['result' => true, 'msg' => '성공적으로 삭제되었습니다.' . $name], JSON_UNESCAPED_UNICODE);
            } else {
                $json = json_encode(['result' => false, 'msg' => '파일 삭제 실패.' . $name], JSON_UNESCAPED_UNICODE);
            }
        }
        echo $json;
    }
}
