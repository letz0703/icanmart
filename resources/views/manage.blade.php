<div class="main__menu mt-6">
    @if (auth()->user() && auth()->user()->isAdmin)
        <div class="main__menu-card">
            <h2>관리</h2>
            <nav class="py-2">
                <ul class="navigation">
                    <li><a href="/boxes/create" class="btn-text">입고등록</a></li>
                    <li><a href="/boxes" class="btn-text">입고목록</a></li>
                    <li><a href="/admin/sellers" class="btn-text">거래처관리</a></li>
                    <li>재고실사 wip</li>
                    <li>판매관리 wip</li>
                    <li><a href="/projects" class="btn-text">프로젝트</a></li>
                </ul>
            </nav>
        </div>
    @endif

</div>
