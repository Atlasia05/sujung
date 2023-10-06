<?php 
    use Art\Core\DB;
    use Art\Core\Lib;

    $uid = $_SESSION['user']->id;
    $SelectBoard = "SELECT * FROM boards WHERE uid = ? ORDER BY id DESC LIMIT ";

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        $nowPage = (int)$page;
        $limit = (int)$page * 6 - 6;
        $data = DB::fetchAll($SelectBoard . $limit . ", 6",[$uid]);
    } else {
        $data = DB::fetchAll($SelectBoard . "0,6",[$uid]);
        $nowPage = 1;
    }

    $pageCnt = DB::fetch("SELECT COUNT(*) AS cnt FROM boards WHERE uid = ?", [$uid]);
    $pageCnt = $pageCnt->cnt;
    $lastPage = $pageCnt % 6 == 0 ? $pageCnt / 6 : $pageCnt / 6 + 1;
    $lastPage = (int)$lastPage;

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

?>
<input type="hidden" style="display: none;" value="<?= $nowPage ?>" id="pageVal">
<h1>내 정보</h1>
<div class="table">
    <div class="table-list" id="intro">
        <p>아이디</p>
        <p>이미지</p>
        <p>날짜</p>
        <p>제목</p>
        <p>가격</p>
        <p>상태</p>
        <p>저장</p>
    </div>
    <?php foreach($data as $d) :?>
        <form action="my-list" method="post" class="table-list">
            <p><?= $d->id ?></p>
            <div class="box">
                <div class="imgbox">
                    <img src="<?= $d->image == '' ? 'images/Static/no_img.jpg' : $d->image ?>" alt="">
                </div>
            </div>
            <p><?= substr($d->date, 0, 10) ?></p>
            <div><a href="/detail?id=<?= $d->id ?>"><?= htmlentities($d->title) ?></a></div>
            <p><?= $d->price ?>원</p>
            <div class="choose">
                <select name="status" id="state">
                    <?php if($d->state == "able") : ?>
                        <option value="able" select>판매중</option>
                        <option value="wait">예약중</option>
                        <option value="done">판매완료</option>
                    <?php elseif($d->state == "wait") : ?>
                        <option value="able">판매중</option>
                        <option value="wait" select>예약중</option>
                        <option value="done">판매완료</option>
                    <?php else : ?>
                        <option value="able">판매중</option>
                        <option value="wait">예약중</option>
                        <option value="done" select>판매완료</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="submit">
                <button type="submit">저장</button>
            </div>
            <input type="hidden" name="id" value="<?= $d->id ?>" style="display: none;">
        </form>
    <?php endforeach; ?>
</div>
<div class="pagination-buttons">
    <a href="/my-list" type="button" class="page-btn start-page">start</a>
    <a href="/my-list?page=<?= (int)$nowPage-1 == 0 ? "1" : (int)$nowPage-1 ?>" type="button" class="page-btn prev-page">prev</a>
    <a href="/my-list?page=<?= $firstNum + 1 ?>" class="page-btn page-btn-num"> <?= $firstNum + 1 ?> </a>
    <a href="/my-list?page=<?= $firstNum + 2 ?>" class="page-btn page-btn-num"> <?= $firstNum + 2 ?> </a>
    <a href="/my-list?page=<?= $firstNum + 3 ?>" class="page-btn page-btn-num"> <?= $firstNum + 3 ?> </a>
    <a href="/my-list?page=<?= $firstNum + 4 ?>" class="page-btn page-btn-num"> <?= $firstNum + 4 ?> </a>
    <a href="/my-list?page=<?= $firstNum + 5 ?>" class="page-btn page-btn-num"> <?= $firstNum + 5 ?> </a>
    <a href="/my-list?page=<?= (int)$nowPage+1 > $lastPage ? (int)$nowPage : (int)$nowPage+1 ?>" type="button" class="page-btn next-page">next</a>
    <a href="/my-list?page=<?= $lastPage ?>" type="button" class="page-btn end-page">end</a>
</div>