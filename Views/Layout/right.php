<div>
    <form class="login" method="post" action="/login">
        <h1>회원정보</h1>
        <?php if(!user()) : ?>
            <input type="text" name="uid" id="uid" placeholder="ID">
            <input type="password" name="pass" id="pass" placeholder="PASSWORD">
        <?php else : ?>
            <div class="inform"><p>ID:</p><h3><?= htmlentities($_SESSION['user']->uid) ?></h3></div>
            <div class="inform"><p>NAME:</p><h3><?= htmlentities($_SESSION['user']->name) ?></h3></div>
        <?php endif; ?>
        <div class="btns">
            <?php if(!user()) : ?>
                <button class="btn" type="submit">로그인</button>
                <a href="/join" class="btn">회원가입</a>
            <?php else : ?>
                <a href="/logout" class="btn logout">로그아웃</a>
            <?php endif; ?>
        </div>
    </form>

    <?php if(user()) : ?>
        <a class="write" href="/upload">글쓰기</a>
        <a class="write" href="/my-page">My Page</a>
        <?php if(user()->uid == 'admin') :?>
            <a class="write" href="/admin">관리자 페이지</a>
        <?php endif; ?>
    <?php endif; ?>
</div>