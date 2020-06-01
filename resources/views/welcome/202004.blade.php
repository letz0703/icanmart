<div class="container">
    @if(auth()->user() && auth()->user()->isAdmin)
        @include('manage')
    @endif
    <div class="card items-center mb-3">
        <div class="flex justify-between">
            <div class="card__menu-title mb-3">
                <h2>인터넷 깡통시장</h2>
                <p class="text-grey">부산 깡통시장 아이템 정보</p>
            </div>
            <div class="card__menu-menu">
                <nav class="py-2">
                    <ul class="navigation">
                        <li><a href="#" class="btn-text">About Us</a></li>
                        <li><a href="#" class="btn-text">Member Shop</a></li>
                        {{--                        <li><a href="#" class="btn-text">Contact</a></li>--}}
                    </ul>
                </nav>
            </div>
        </div>
        <div>
            <a href="" class='button'>구매요청</a>
        </div>
    </div>
    {{--        @include('layouts.grid')--}}

    @include('layouts.section-feature')

    <section class="section-items mb-10">
        <div class="text-center u-margin-bottom-big">
            <h2 class="heading-secondary uppercase">Popular Items</h2>
            <div class="row">
                <div class="col-1-of-3">
                    <div class="rotate-card">
                        <div class="rotate-card__side rotate-card__side--front">
                            동전파스
                        </div>
                        <div class="rotate-card__side rotate-card__side--back rotate-card__side--back-1">
                            동전파스
                        </div>

                    </div>
                </div>
                <div class="col-1-of-3">
                    <div class="item-card">
                        <div class="item-card__side">
                            곤약젤리
                        </div>
                    </div>
                </div>
                <div class="col-1-of-3">
                    <div class="item-card">
                        <div class="item-card__side">
                            맥심커피
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
