<?php
    use Art\Core\DB;
    use Art\Core\Lib;

    require_once("pagenation.php");

    /* $boardSelect = "SELECT * FROM boards WHERE status != 'done'"; // boards에 있는 자료들 찾는 것

    isset($_GET['page']) ? $page = $_GET['page'] : $page = '';
    isset($_GET['search']) ? $search = $_GET['search'] : $search = '';
    $lastPage = 0;
    $nowPage = (int)$page;
    isset($_GET['page']) ? $limit = (int)$page * 6 - 6 : "";
    
    if(isset($_GET['page']) && isset($_GET['search'])) {
        $data = DB::fetchAll("AND title LIKE '%" . $search . "%' ORDER BY id DESC LIMIT " . $limit . ", 6",[]);
    }elseif(isset($_GET['page'])) {
        $data = DB::fetchAll($boardSelect ." ORDER BY id DESC LIMIT " . $limit . ", 6",[]);
    }elseif(isset($_GET['search'])) {
        $query = $boardSelect ." AND title LIKE '%" . $search . "%' ORDER BY id DESC LIMIT 0, 6";        
        $data = DB::fetchAll($query, []);
        $nowPage = 1;
    }
    else {
        $data = DB::fetchAll($boardSelect ." ORDER BY id DESC LIMIT 0,6",[]);
        $nowPage = 1;
    }

    $countSelect = "SELECT COUNT(*) as cnt FROM boards WHERE status != 'done'"; // 보드의 데이터 갯수를 카운트함
    $countSearch = " AND title LIKE '%". $search . "%'"; // search가 있을경우

    function LastPage($pageCnt) {
        $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
        $lastPage = (int)$lastPage;
    }

    if(isset($_GET['page']) && isset($_GET['search'])) {
        $pageCnt = DB::fetch($countSelect . $countSearch);
        LastPage((int)$pageCnt->cnt);

    } elseif(isset($_GET['search'])) {
        $pageCnt = DB::fetch($countSelect . $countSearch);
        LastPage((int)$pageCnt->cnt);
    }
    else {
        $pageCnt = DB::fetch($countSelect);
        LastPage((int)$pageCnt->cnt);
    }
    

    if($lastPage < 5) {
        $firstNum = 0;
    }

    else {
        if($lastPage-$nowPage <= 2) {
            $firstNum = $lastPage - 5;
        } elseif($nowPage-2 <= 1) {
            $firstNum = 0;
        } else {
            $firstNum = $nowPage-3;
        }
    }

    if($nowPage > $lastPage) {
        Lib::MsgAndBack("존재하지 않은 페이지입니다.");
        exit;
    }
    */
?>  
<input type="hidden" style="display: none;" value="<?= $nowPage ?>" id="pageVal">
<div class="view">
    <h3 class="main-title">중고물품</h3>
    <ul>
        <?php foreach ($data as $idx=>$d): ?>
            <?php $class = DB::fetch("SELECT * FROM users WHERE id = ?", [$d->uid]); ?>
            <?php if($idx < 3) : ?>
                <li class="list">
                    <div class="box">
                        <?php if($d->image != ""): ?>
                            <img src="<?= $d->image ?>" alt="">
                        <?php else : ?>
                            <img src="images/Static/no_img.jpg" alt="">
                        <?php endif; ?>
                        <?php if($d->status == "wait") : ?>
                            <div class="wait">
                                <p>예약중</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="/detail?id=<?= $d->id ?>"><?= htmlentities($d->title) ?></a>
                    <p><?= $class->class ?></p>
                    <p class="price"><?= $d->price ?>원</p>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <ul>
        <?php foreach ($data as $idx=>$d): ?>
            <?php $class = DB::fetch("SELECT * FROM users WHERE id = ?", [$d->uid]); ?>
            <?php if($idx >= 3) : ?>
                <li class="list">
                    <div class="box">
                        <?php if($d->image != ""): ?>
                            <img src="<?= $d->image ?>" alt="">
                        <?php else : ?>
                            <img src="images/Static/no_img.jpg" alt="">
                        <?php endif; ?>
                        <?php if($d->status == "wait") : ?>
                            <div class="wait">
                                <p>예약중</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="/detail?id=<?= $d->id ?>"><?= htmlentities($d->title) ?></a>
                    <p><?= $class->class ?></p>
                    <p class="price"><?= $d->price ?>원</p>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <div class="pagination-buttons">
        <?php if(isset($_GET['search'])) : ?>
            <a href="/?search=<?= $search ?>" type="button" class="page-btn start-page">start</a>
            <a href="/?search=<?= $search ?>&page=<?= (int)$nowPage-1 == 0 ? "1" : (int)$nowPage-1 ?>" type="button" class="page-btn prev-page">prev</a>
            <a href="/?search=<?= $search ?>&page=<?= $firstNum + 1 ?>" class="page-btn page-btn-num"> <?= $firstNum + 1 ?> </a>
            <a href="/?search=<?= $search ?>&page=<?= $firstNum + 2 ?>" class="page-btn page-btn-num"> <?= $firstNum + 2 ?> </a>
            <a href="/?search=<?= $search ?>&page=<?= $firstNum + 3 ?>" class="page-btn page-btn-num"> <?= $firstNum + 3 ?> </a>
            <a href="/?search=<?= $search ?>&page=<?= $firstNum + 4 ?>" class="page-btn page-btn-num"> <?= $firstNum + 4 ?> </a>
            <a href="/?search=<?= $search ?>&page=<?= $firstNum + 5 ?>" class="page-btn page-btn-num"> <?= $firstNum + 5 ?> </a>
            <a href="/?search=<?= $search ?>&page=<?= (int)$nowPage+1 > $lastPage ? (int)$nowPage : (int)$nowPage+1 ?>" type="button" class="page-btn next-page">next</a>
            <a href="/?search=<?= $search ?>&page=<?= $lastPage ?>" type="button" class="page-btn end-page">end</a>
        <?php else : ?>
            <a href="/" type="button" class="page-btn start-page">start</a>
            <a href="/?page=<?= (int)$nowPage-1 == 0 ? "1" : (int)$nowPage-1 ?>" type="button" class="page-btn prev-page">prev</a>
            <a href="/?page=<?= $firstNum + 1 ?>" class="page-btn page-btn-num"> <?= $firstNum + 1 ?> </a>
            <a href="/?page=<?= $firstNum + 2 ?>" class="page-btn page-btn-num"> <?= $firstNum + 2 ?> </a>
            <a href="/?page=<?= $firstNum + 3 ?>" class="page-btn page-btn-num"> <?= $firstNum + 3 ?> </a>
            <a href="/?page=<?= $firstNum + 4 ?>" class="page-btn page-btn-num"> <?= $firstNum + 4 ?> </a>
            <a href="/?page=<?= $firstNum + 5 ?>" class="page-btn page-btn-num"> <?= $firstNum + 5 ?> </a>
            <a href="/?page=<?= (int)$nowPage+1 > $lastPage ? (int)$nowPage : (int)$nowPage+1 ?>" type="button" class="page-btn next-page">next</a>
            <a href="/?page=<?= $lastPage ?>" type="button" class="page-btn end-page">end</a>
        <?php endif; ?>

    </div>
</div>
