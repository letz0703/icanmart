<div class="mx-auto flex bg-blue-500 lg:w-auto">
    <div class="is-hidden-mobile md:mx-auto py-6 container w-1/2">
        <h5 class="text-white font-semibold uppercase">Shop</h5>
        <ul class="leading-loose">
            <li><a href="#" class="text-transparent-50 hover:text-white">JAPAN TO KOREA</a></li>
            <li><a href="#" class="text-transparent-50 hover:text-white">VIP ONLINE(Under Construction)</a></li>
{{--            <li><a href="#" class="text-transparent-50 hover:text-white">Apparel</a></li>--}}
            @unless(Route::has('login'))
                <li><a href="{{ route('register') }}" class="text-transparent-50 hover:text-white">Sign Up</a></li>
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

    <div class="is-hidden-mobile py-6 container w-1/2" >
        <h5 class="text-white font-semibold uppercase">Contact Us</h5>
        <ul class="leading-loose">
            <li><a href="mailto:icanmart@gmail.com" class="text-transparent-50 hover:text-white">
                    Email: icanmart@gmail.com</a>
            </li>
            <li><a href="#" class="text-transparent-50 hover:text-white">Board</a></li>
            <li>
                <support-button></support-button>
            </li>
        </ul>
    </div>
</div>
