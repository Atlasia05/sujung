<h2>회원가입</h2>
<form method="post" action="/join" onsubmit="return Submit()">
    <div class="form-group">
        <label>사용자 이름:</label>
        <input type="text" name="name" id="username" placeholder="사용자 이름을 입력해주세요" required>
    </div>
    <div class="form-group">
        <div class="idForm">
            <label>아이디:</label>
            <div class="checkID"></div>
        </div>
        <div class="user">
            <input type="text" name="uid" id="userid" placeholder="사용하실 아이디을 입력해주세요" required>
            <div id="overlap">중복확인</div>
        </div>
        <input type="hidden" style="display: none;" id="complete" value="">
    </div>
    <div class="form-group">
        <label>전화번호:</label>
        <input type="text" name="phone" id="phone" onkeyup="formatPhoneNumber()" placeholder="전화번호를 입력해주세요" required>
    </div>
    <div class="form-group">
        <label>학번:</label>
        <input type="text" name="class" id="class" onkeyup="formatClassNumber()" placeholder="예시: 30101" required>
    </div>
    <div class="form-group">
        <label>비밀번호:</label>
        <input type="password" name="pass1" id="password" placeholder="사용하실 비밀번호를 입력해주세요" required>
    </div>
    <div class="form-group">
        <label>비밀번호 재확인:</label>
        <input type="password" name="pass2" placeholder="사용하실 비밀번호를 입력해주세요" required>
    </div>
    <div class="form-group">
        <button type="submit">회원가입</button>
    </div>
</form>