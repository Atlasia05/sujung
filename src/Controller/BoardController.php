<?php

namespace Gondr\Controller;
use Gondr\Core\Lib;

class BoardController extends MasterController
{
    public function viewPage()
    {
        if(!isset($_GET['id'])){
            Lib::MsgAndBack("글번호가 없습니다.");
            return;
        }

        $idx = $_GET['id']; //이게 글번호가 되는거
        
        //여기서 글번호로 DB에서 글을 가져와서 글이 보여지는 것까지 만들어봐


        // 맨처음에 Web.php에다가 "/board/view" 주소를 적절하게 등록해줘야 해
        // 그다음에 view.php를 Views 폴더안에 만들고 적절하게 채워넣고
        // 여기서 데이터랑 view랑 같이 넘겨서 MasterController 의 view를 호출해야해
    }
}