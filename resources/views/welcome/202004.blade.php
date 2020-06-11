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

    <section class="section-items">
        <div class="text-center u-margin-bottom-big">
            <h2 class="heading-secondary uppercase">Popular Items</h2>
            <div class="row mb-10">
                <div class="col-1-of-3">
                    <div class="rotate-card">
                        <div class="rotate-card__side rotate-card__side--front rotate-card__side--front-1">
                            <div class="rotate-card__picture rotate-card__picture--1">
                                &nbsp;
                            </div>
                            <h4 class="rotate-card__heading">
                                <span class="rotate-card__heading-span rotate-card__heading-span--1 px-2 py-1">Pain Relief Patches
                                </span>
                            </h4>
                            <div class="rotate-card__detail">
                                <ul>
                                    <li>여행 필수구매 아이템</li>
                                    <li>100원 크기-156매</li>
                                    <li>500원 크기-78매</li>
                                </ul>
                            </div>


                        </div>
                        <div class="rotate-card__side rotate-card__side--back rotate-card__side--back--1">

                            <div class="rotate-card__heading pt-2">동전파스 9800원</div>
                            <div class="rotate-card__detail text-xl -mt-1">
                                <a href="https://www.roihi.com/en/tubokou.html" target="_blank">homepage</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-1-of-3">
                    <div class="rotate-card">
                        <div class="rotate-card__side rotate-card__side--front">
                            <div class="rotate-card__heading p-2">추천 아이템</div>
                            <div class="rotate-card__heading pt-2 mb-2">용각산 사탕</div>
                            <div class="rotate-card__detail text-xl -mt-1">
                                목이 따갑거나 아플 때
                            </div>
                            <p class="font-normal md:text-base">한알이면 끝</p>
                        </div>
                        <div class="rotate-card__side rotate-card__side--back rotate-card__side--back--1">
{{--                            <div class="rotate-card__picture rotate-card__picture--1">--}}
{{--                                &nbsp;--}}
{{--                            </div>--}}
                            <div class="rotate-card__heading pt-2">용각산사탕 5000원</div>
                            <div class="rotate-card__detail text-xl -mt-1">
                                <a href="https://www.ryukakusan.co.jp/productcategory/en" target="_blank">homepage</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1-of-3">
                    <div class="rotate-card">
                        <div class="rotate-card__side rotate-card__side--front">
                            <div class="rotate-card__heading p-2">여름 아이템</div>
                            <div class="rotate-card__heading pt-2 mb-2">블랜디 액상커피</div>
                            <div class="rotate-card__detail text-xl -mt-1">
                                아이스 커피용 커피 원액
                            </div>
                            <p class="font-normal md:text-base">간편하고 맛있게 즐기세요</p>
                        </div>
                        <div class="rotate-card__side rotate-card__side--back rotate-card__side--back--1">
                            {{--                            <div class="rotate-card__picture rotate-card__picture--1">--}}
                            {{--                                &nbsp;--}}
                            {{--                            </div>--}}
                            <div class="rotate-card__heading pt-2">블랜디 액상커피 8개입 2700원</div>
                            <div class="rotate-card__detail text-xl -mt-1">
                                <a href="https://blendy.agf.jp/portion/" target="_blank">homepage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
