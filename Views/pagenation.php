<?php
    use Art\Core\DB;
    use Art\Core\Lib;

    $mainDB = $phpstyle == "" ? "boards" : "users";

    isset($_GET['page']) ? $page = $_GET['page'] : ''; //페이지 있는지 감지 있으면 페이지값 없으면 NULL
    isset($_GET['search']) ? $search = $_GET['search'] : $search = ''; //서치 있는지 감지
    $page != '' ? $nowPage = (int)$page : $nowPage = 1; // 페이지 이으면 페이지 값 아니면 1
    $page != '' ? $limit = (int)$page * 6 - 6 : ''; // 페이지 있으면 페이지 / 6 값


    $OrderById = "ORDER BY id DESC LIMIT"; // ID기준으로 내림차순 정렬
    if($mainDB == "boards") { // main페이지 일 경우
        $selectMain = "SELECT * FROM " . $mainDB . "WHERE status != 'done'";
        $selectSearch = "AND title LIKE '%" . $search . "%' $OrderById";
    } else { // admin페이지 일 경우
        $selectMain = "SELECT * FROM users";
        $selectSearch = "WHERE class = ? OR name LIKE '%" . $search . "%'" . $OrderById;
    }

    
    if(isset($_GET['page']) && isset($_GET['search'])) {
        $data = DB::fetchAll($selectMain . $selectSearch . $limit . ", 6",[]);
    } elseif(isset($_GET['page'])) {
        $data = DB::fetchAll($selectMain . $OrderById . $limit . ", 6",[]);
    } elseif(isset($_GET['search'])) {
        $data = DB::fetchAll($selectMain . $selectSearch ." 0, 6", []);
    } else {
        $data = DB::fetchAll($selectMain . $OrderById ." 0,6",[]);
    }


    $lastPage = null;
    if($mainDB == "boards") {
        $countBoard = "SELECT COUNT(*) as cnt FROM $mainDB WHERE status != 'done'";
        isset($search) ? $countSearch = " AND title LIKE '%". $search . "%'" : '';
    } else {

    }


    if(isset($_GET['page']) && isset($_GET['search'])) {
        $pageCnt = DB::fetch($countBoard . $countSearch);
        $lastPage = LastPage($pageCnt);
    } elseif(isset($_GET['search'])) {
        $pageCnt = DB::fetch($countBoard . $countSearch);
        $lastPage = LastPage($pageCnt);
    } else {
        $pageCnt = DB::fetch($countBoard);
        $lastPage = LastPage($pageCnt);
    }

    $firstNum = 0;
    
    if($lastPage < 5) {
        $firstNum = 0;
    } else {
        if($lastPage-$nowPage <= 2) {
            $firstNum = $lastPage - 5;
        } elseif($nowPage-2 <= 1) {
            $firstNum = 0;
        } else {
            $firstNum = $nowPage-3;
        }
    }

    function LastPage($pageCnt) {
        global $lastPage;
        $pageCnt = (int)$pageCnt->cnt;
        $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
        return (int)$lastPage;
    }
    