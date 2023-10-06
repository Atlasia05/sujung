<?php
    use Art\Core\DB;

    $user = DB::fetch("SELECT * FROM users WHERE id = ?", [$_SESSION['user']->id]);
?>
<form id="myForm" action="/my-page" method="post" enctype="multipart/form-data">
    <div class="profile">
        <input type="file" name="profile" id="pro" onchange="setThumbnail(event)" accept="image/*">
        <input type="text" id="noImage" name="noImage" style="display: none">
        <label for="pro" class="profileBox">
            <img class="" src="<?= $user->image ?>" alt="">
        </label>
        <div class="btn noImage">이미지 없음</div>
    </div>
    <div action="mypage" method="post" enctype="multipart/form-data" class="data">
        <h1>My Profile</h1>
        <div class="rowBox">
            <h3>ID</h3>
            <input type="text" class="read" name="id" value="<?= $user->uid ?>" readonly>
        </div>
        <div class="rowBox">
            <h3>NAME</h3>
            <input type="text" name="name" value="<?= $user->name ?>">
        </div>
        <div class="rowBox">
            <h3>CLASS</h3>
            <input type="text" class="read" name="" value="<?= $user->class ?>" readonly>
        </div>
        <div class="rowBox">
            <h3>PHONE</h3>
            <input type="text" class="read" name="" value="<?= $user->phone ?>" readonly>
        </div>
        <div class="rowBox">
            <h1>바로가기</h1>
        </div>
        <div class="rowBox multiBox">
            <a href="/">
                <div class="imgBox">
                    <img src="images/Static/home.png" alt="">
                </div>
                <p>Home</p>
            </a>
            <a href="upload">
                <div class="imgBox">
                    <img src="images/Static/upload.png" alt="">
                </div>
                <p>글쓰기</p>
            </a>
            <a href="my-list">
                <div class="imgBox">
                    <img src="images/Static/list.jpg" alt="">
                </div>
                <p>내 게시글</p>
            </a>
        </div>
        <div class="rowBox btnes">
            <input type="submit" id="save">
            <label for="save" class="btn save">SAVE</label>
        </div>
    </div>
</form>
