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

    <section class="section-features">
        <div class="row">
            <div class="col-1-of-4">
                <div class="feature-box">
                    <a href="/items/search">
                        <i class="feature-box__icon icon-basic-magnifier"></i>
                        <h3 class="heading-tertiary u-margin-bottom-small">
                            아이템 검색
                        </h3>
                        <p class="feature-box__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                            esse.</p>
                    </a>
                </div>
            </div>
            <div class="col-1-of-4">
                <div class="feature-box">
                    <i class="feature-box__icon icon-basic-heart"></i>
                    <h3 class="heading-tertiary u-margin-bottom-small">구매 요청</h3>
                    <p class="feature-box__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        esse.</p>
                </div>
            </div>

            <div class="col-1-of-4">
                <div class="feature-box">
                    <i class="feature-box__icon icon-basic-star"></i>
                    <h3 class="heading-tertiary u-margin-bottom-small">배송 확인</h3>
                    <p class="feature-box__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        esse.</p>
                </div>
            </div>
            <div class="col-1-of-4">
                <div class="feature-box">
                    <i class="feature-box__icon icon-basic-message-multiple"></i>
                    <h3 class="heading-tertiary u-margin-bottom-small">정보 공유</h3>
                    <p class="feature-box__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem,
                        esse.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-items">
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
