<div class="container">
    <div class="card items-center mb-3">
        <div class="flex justify-between">
            <div class="card__menu-title mb-3">
                <h2>인터넷 깡통시장</h2>
                <p class="text-grey">부산 깡통시장 구매대행</p>
            </div>
            <div class="card__menu-menu">
                <nav class="py-2">
                    <ul class="navigation">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div>
            <a href="" class='button'>구매요청</a>
        </div>
    </div>
    <div class="main__menu">
        <div class="main__menu-card">
            <a href="/items/search">
                아이템 검색
            </a>
        </div>
        <div class="main__menu-card">오늘의 상품</div>
        @if (auth()->user() && auth()->user()->isAdmin())
            <div class="main__menu-card">
                <h2>관리</h2>
                <nav class="py-2">
                    <ul class="navigation">
                        <li><a href="/boxes/create">입고등록</a></li>
                        <li><a href="/boxes">입고목록</a></li>
                        <li>재고실사 wip</li>
                        <li>판매관리 wip</li>
                        <li><a href="/projects">프로젝트</a></li>

                    </ul>
                </nav>
            </div>

        @endif

    </div>
</div>
