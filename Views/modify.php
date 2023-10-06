<?php 
    use Art\Core\DB;
    $data = DB::fetch("SELECT * FROM boards WHERE id = ?", [$_GET['id']]);
?>
<div class="Upload-title">
    <p class="Upload-title-p">해당 페이지에서는 기존 글을 수정할 수 있습니다<br>
        마켓에 올린 제품은 <b>[내정보]</b> 페이지에서 확인하거나 회수할 수 있습니다</p>
</div>

<div class="container">
    <form action="/modify" method="post" enctype="multipart/form-data">
        <div class="left">
            <ul class="Upload-img shwon">
                <!-- 이미지 미리보기가 들어갈 장소 -->
                <?php if($data->image != ""): ?>
                    <li style="background-color: white;">
                        <img id="mainImg" src="<?= $data->image ?>" alt="">
                    </li>
                <?php else: ?>
                    <li style="background-color: white;">
                        <img id="mainImg" src="images/Static/no_img.jpg" alt="">
                    </li>
                <?php endif; ?>
            </ul>
            <div class="Upload-img-form">
                <input type="file" class="Upload-img-input" name="chooseFile" id="chooseFile" accept="image/*" onchange="setThumbnail(event);">
                <input type="hidden" name="no_img" id="noo_img" style="display: none" value="false">
                <label for="chooseFile" class="Upload-img-label">
                    이미지 변경
                </label>
                <button id="no_img" type="button" class="Upload-img-label">
                    이미지 없음
                </button>
            </div>

            <button class="Upload-button Upload-button-left" onclick="open_modal()">UPDATE</button>
        </div>

        <div class="right">
            <h2 class="contents-h2">상세 정보</h2>

            <ul class="contents-ul">
                <li class="contents-li"><p class="contents-p">제목 <span class="contents-span">*</span></p>
                    <input type="text" name="title" class="contents-textarea contents-name" placeholder="필수 입력 사항입니다." value="<?= htmlentities($data->title) ?>" required>
                </li>
                <li class="contents-li"><p class="contents-p">내용 <span class="contents-span">*</span></p>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="comment" placeholder="필수 입력 사항입니다" required><?= htmlentities($data->comment) ?></textarea>
                </li>
                <li class="contents-li"><p class="contents-p">가격 <span class="contents-span">*</span></p>
                    <input type="text" onkeyup="formatPhoneNumber()" name="price" class="contents-textarea contents-price" placeholder="필수 입력 사항입니다." value="<?= $data->price ?>">
                </li>
                <input type="text" name="id" value="<?= $_GET['id'] ?>" style="display: none">
            </ul>

            <a href="/" class="Upload-button Upload-button-right cansleBtn">HOME</a>
        </div>
    </form>
</div>
