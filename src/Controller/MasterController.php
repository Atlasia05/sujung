<?php 

namespace Art\Controller;

class MasterController 
{
    public function view($page, $data= [])
    {
        extract($data); // 배열을 변수로 변경해주는 녀석
        require_once(__VIEW . "/Layout/Skelecton.php");
    }
}