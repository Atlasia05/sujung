<header>
    <div class="inner">
        <h1 class="logo">
            <a href="/">
                <img src="images/Static/logo.png" alt="">
                <p class="logo_name">수정마켓</p>
            </a>
        </h1>
        <ul>
            <li>
                <a href="https://swjb-h.goesw.kr/index.do" target="_blank">수원정보과학고 홈페이지</a>
                <div class="line"></div>
            </li>
            <li>
                <a href="https://www.instagram.com/swjb._.hb/" target="_blank">수원정보과학고 인스타</a>
                <div class="line"></div>
            </li>
            <li>
                <a href="https://swjb-h.goesw.kr/subList/31000019471" target="_blank">오늘의 급식</a>
                <div class="line"></div>
            </li>
        </ul>
        <?php if($phpstyle == "") :?>
            <form class="search" method="GET">
                <input type="text" name="search" id="search-form" placeholder="Search">
                <button class="icon"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        <?php endif; ?>
    </div>
</header>