<div class="Upload-title">
    <p class="Upload-title-p">해당 페이지에서는 원하는 제품을 마켓에 올릴 수 있습니다.<br>
        마켓에 올린 제품은 <b>[내정보]</b> 페이지에서 확인하거나 회수할 수 있습니다</p>
</div>

<div class="container">
    <form action="/upload" method="post" enctype="multipart/form-data">
        <div class="left">
            <ul class="Upload-img">
                <!-- 이미지 미리보기가 들어갈 장소 -->
            </ul>
            <div class="Upload-img-form">
                <input type="file" class="Upload-img-input" name="chooseFile" id="chooseFile" accept="image/*" onchange="setThumbnail(event);">
                <label for="chooseFile" id="add_img" class="Upload-img-label">
                    이미지 추가
                </label>
            </div>

            <button class="Upload-button Upload-button-left" onclick="open_modal()">UPLOAD</button>
        </div>

        <div class="right">
            <h2 class="contents-h2">상세 정보</h2>

            <ul class="contents-ul">
                <li class="contents-li"><p class="contents-p">제목 <span class="contents-span">*</span></p>
                    <input type="text" name="title" class="contents-textarea contents-name" placeholder="필수 입력 사항입니다.">
                </li>
                <li class="contents-li"><p class="contents-p">내용 <span class="contents-span">*</span></p>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="comment" placeholder="필수 입력 사항입니다."></textarea>
                </li>
                <li class="contents-li"><p class="contents-p">가격 <span class="contents-span">*</span></p>
                    <input type="text" onkeyup="formatPhoneNumber()" name="price" class="contents-textarea contents-price" placeholder="필수 입력 사항입니다.">
                </li>
            </ul>

            <a href="/" class="Upload-button Upload-button-right cansleBtn">HOME</a>
        </div>
    </form>
</div>
