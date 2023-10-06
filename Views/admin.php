<?php 
    use Art\Core\DB;
    use Art\Core\Lib;

    if(isset($_GET['page']) && isset($_GET['search'])) {
        $page = $_GET['page'];
        $search = addcslashes($_GET['search']);
        $nowPage = (int)$page;
        $limit = (int)$page * 6 - 6;
        $data = DB::fetchAll("SELECT * FROM users WHERE class = ? OR name LIKE '%" . $search . "%' ORDER BY id  LIMIT " . $limit . ", 6",[$search]);
    }
    else if(isset($_GET['page'])) {
        $page = $_GET['page'];
        $nowPage = (int)$page;
        $limit = (int)$page * 6 - 6;
        $data = DB::fetchAll("SELECT * FROM users ORDER BY id  LIMIT " . $limit . ", 6",[]);
    }
    else if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $data = DB::fetchAll("SELECT * FROM users WHERE class = ? OR name LIKE '%" . $search . "%' ORDER BY id  LIMIT 0, 6", [$search]);
        $nowPage = 1;
    }
    else {
        $data = DB::fetchAll("SELECT * FROM users ORDER BY id LIMIT 0,6",[]);
        $nowPage = 1;
    }


    if(isset($_GET['page']) && isset($_GET['search'])) {
        $search = $_GET['search'];
        $pageCnt = DB::fetch("SELECT COUNT(*) as cnt FROM users WHERE class = ? OR name LIKE '%". $search . "%'", [$search]);
        $pageCnt = $pageCnt->cnt;
        $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
        $lastPage = (int)$lastPage;
    }
    else if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $pageCnt = DB::fetch("SELECT COUNT(*) as cnt FROM users WHERE class = ? OR name LIKE '%". $search . "%'", [$search]);
        $pageCnt = $pageCnt->cnt;
        $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
        $lastPage = (int)$lastPage;
    }
    else {
        $pageCnt = DB::fetch("SELECT COUNT(*) AS cnt FROM users");
        $pageCnt = $pageCnt->cnt;
        $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
        $lastPage = (int)$lastPage;
    }
    

    if($lastPage < 5) {
        $firstNum = 0;
    }
    else {
        if($lastPage-$nowPage <= 2) {
            $firstNum = $lastPage - 5;
        }elseif($nowPage-2 <= 1) {
            $firstNum = 0;
        }else {
            $firstNum = $nowPage-3;
        }
    }

    if($pageCnt == 0) {
        Lib::MsgAndBack("해당 사용자가 없습니다.");
        exit;
    }

    if($nowPage > $lastPage) {
        Lib::MsgAndBack("존재하지 않은 페이지입니다.");
        exit;
    }

?>
<input type="hidden" style="display: none;" value="<?= $nowPage ?>" id="pageVal">
<div>

</div>
<div class="adminTitle">
    <h1>사용자 정보</h1>
    <button id="exel_down">엑셀 다운로드</button>
    <form class="search" method="GET">
        <input type="text" name="search" id="search-form" placeholder="Search">
        <button class="icon"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>
<div class="table">
    <div class="table-list" id="intro">
        <p>사용자 번호</p>
        <p>사용자 이미지</p>
        <p>사용자 아이디</p>
        <p>사용자 이름</p>
        <p>사용자 학번</p>
        <p>사용자 비밀번호</p>
        <p>사용자 관리</p>
    </div>
    <?php foreach($data as $d) :?>
        <form action="admin" method="post" class="table-list">
            <div><input type="text" name="id" id="<?= $d->id ?>" value="<?= $d->id ?>" disabled></div>
            <div class="box">
                <div class="imgbox">
                    <img src="<?= $d->image ?>" alt="">
                </div>
            </div>
            <p><?= $d->uid ?></p>
            <div><input class="inputs<?= $d->id ?>" name="name" type="text" value="<?= htmlentities($d->name) ?>" disabled></div>
            <div><input class="inputs<?= $d->id ?>" name="class" type="text" value="<?= $d->class ?>" disabled></div>
            <div class="choose">
                <p>****</p>
            </div>
            <div class="submit submit<?= $d->id ?>">
                <button type="button" data-uid="<?= $d->id ?>" onclick="Modify(this)">수정</button>
                <a href="userDel?id=<?= $d->id ?>" class="del">삭제</a>
            </div>
            <input type="hidden" name="id" value="<?= $d->id ?>" style="display: none;">
        </form>
    <?php endforeach; ?>
</div>
<div class="pagination-buttons">
    <a href="/admin" type="button" class="page-btn start-page">start</a>
    <a href="/admin?page=<?= (int)$nowPage-1 == 0 ? "1" : (int)$nowPage-1 ?>" type="button" class="page-btn prev-page">prev</a>
    <a href="/admin?page=<?= $firstNum + 1 ?>" class="page-btn page-btn-num"> <?= $firstNum + 1 ?> </a>
    <a href="/admin?page=<?= $firstNum + 2 ?>" class="page-btn page-btn-num"> <?= $firstNum + 2 ?> </a>
    <a href="/admin?page=<?= $firstNum + 3 ?>" class="page-btn page-btn-num"> <?= $firstNum + 3 ?> </a>
    <a href="/admin?page=<?= $firstNum + 4 ?>" class="page-btn page-btn-num"> <?= $firstNum + 4 ?> </a>
    <a href="/admin?page=<?= $firstNum + 5 ?>" class="page-btn page-btn-num"> <?= $firstNum + 5 ?> </a>
    <a href="/admin?page=<?= (int)$nowPage+1 > $lastPage ? (int)$nowPage : (int)$nowPage+1 ?>" type="button" class="page-btn next-page">next</a>
    <a href="/admin?page=<?= $lastPage ?>" type="button" class="page-btn end-page">end</a>
</div>