<?php
    use Art\Core\DB;
    $data = DB::fetch("SELECT * FROM boards WHERE id = ?", [$_GET['id']]);
    $user = DB::fetch("SELECT * FROM users WHERE id = ?", [$data->uid]);
    $comment = DB::fetchAll("SELECT * FROM comment WHERE bid = ? ORDER BY id DESC", [$data->id]);
?>
<div class="main-img">
    <?php if($data->image != ""): ?>
        <img src="<?= $data->image ?>" id="mainImg" alt="상품이미지">
    <?php else : ?>
        <img src="images/static/no_img.jpg" id="mainImg" alt="상품이미지">
    <?php endif; ?>
</div>
<div class="user-info">
    <?php if($user->image != ""): ?>
        <div class="user-img"><img src="<?= $user->image ?>" alt="프로필 사진"></div>
    <?php else : ?>
        <div class="user-img"><img src="<?= $user->image ?>" alt="프로필 사진"></div>
    <?php endif; ?>
    <div class="user-info2">
        <h2 class="user-name"><?= htmlentities($user->name) ?></h2>
        <p class="user-number"><?= $user->class ?></p>
    </div>
    <?php if(user()): ?>
        <?php if($data->uid == $_SESSION['user']->id) : ?>
            <div class="btns userBtn">
                <a href="modify?id=<?= $data->id ?>" class="btn edit">수정</a>
                <a href="delete?id=<?= $data->id ?>" class="btn del">삭제</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div class="object-contents">
    <h1 class="object-name"><?= htmlentities($data->title) ?></h1>
    <p class="price"><?= $data->price ?>원</p>
    <div class="object-info">
        <pre readonly><?= htmlentities($data->comment) ?></pre>
    </div>
</div>
<?php if(user()) : ?>
    <form action="/detail?id=<?= $data->id ?>" method="post">
        <h1>글 쓰기</h1>
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <button type="submit">등록하기</button>
    </form>
<?php endif; ?>

<ul class="commentlist">
    <h2>댓글</h2>
    <?php foreach($comment as $c) : ?>
        <li>
            <div class="userForm">
                <div class="imgBox">
                    <img src="<?= $c->uimage ?>" alt="">
                </div>
                <div class="">
                    <div class="row1">
                        <h4 class="uname"><?= $c->uname ?></h4>
                        <?php if(user()) : ?>
                            <?php if($c->uname == user()->name || user()->uid == "admin") : ?>
                                <a href="/commentDel?id=<?= $c->id ?>" class="delete">삭제</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row1">
                        <p class="time"><?= $c->date ?></p>
                    </div>
                </div>
            </div>
            <textarea class="comment" disabled><?= htmlentities($c->comment) ?></textarea>
        </li>
    <?php endforeach ?>
</ul>