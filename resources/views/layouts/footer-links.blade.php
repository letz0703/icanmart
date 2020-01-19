<div class="section flex bg-blue-500 h-screen md:h-full">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="box">
                    <h5 class="text-white font-semibold uppercase">Shop</h5>
                    <ul class="leading-loose">
                        <li><a href="#" class="text-transparent-50 hover:text-white">JAPAN TO KOREA</a></li>
                        <li><a href="#" class="text-transparent-50 hover:text-white">VIP ONLINE</a>
                        </li>
                        {{--            <li><a href="#" class="text-transparent-50 hover:text-white">Apparel</a></li>--}}
                        @unless(Route::has('login'))
                            <li><a href="{{ route('register') }}" class="text-transparent-50 hover:text-white">Sign
                                    Up</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="text-transparent-50 hover:text-white"
                                    {{--                   @click.prevent="dispatch('login')"--}}
                                >
                                    Sign Up
                                </a>
                            </li>
                        @endunless
                    </ul>
                </div>
            </div>


            <div class="col">
                <div class="box">
                    <h5 class="text-white font-semibold uppercase">Contact Us</h5>
                    <ul class="leading-loose">
                        <li><a href="mailto:icanmart@gmail.com" class="text-transparent-50 hover:text-white">
                                Email: icanmart@gmail.com</a>
                        </li>
                        <li><a href="#" class="text-transparent-50 hover:text-white">Board</a></li>
                        <li>
                            <support-button class="text-transparent-50 hover:text-white"></support-button>
                        </li>
                    </ul>
                </div>
            </div>
            @can('update')
                <div class="col">
                    <div class="box">
                        <h5 class="text-white font-semibold uppercase">Admin</h5>
                        <ul class="leading-loose">
                            <li><a href="/boxes/create" class="text-transparent-50 hover:text-white">
                                    입고등록</a>

                            </li>
                            <li><a href="/nova" class="text-transparent-50 hover:text-white">
                                    NOVA</a>
                            </li>
                            <li><a href="/items/search" class="text-transparent-50 hover:text-white">
                                    SEARCH</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
