<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    {{--    <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/bulma">--}}
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/ic.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

</head>
<body>
<header>
    <div class="container">
        <div class="header-top">
            <div>
                <h1>
                    {{ env('APP_NAME') }}
                </h1>
            </div>
            @if (Route::has('login'))
                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <nav>
            <a href="items/search">SEARCH BARCODE</a>
            @can('update')
                <a href="/nova">NOVA</a>
                <a href="boxes/create">입고등록</a>
            @endcan
        </nav>
    </div>
</header>

<div class="content">
    <div class="container">
        <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround":true }'>
            <div class="carousel-cell">
                <img src="/images/carousel.jpg">

            </div>
            {{--            <div class="carousel-cell">--}}
            {{--                <img src="/images/carousel-img-blendy.jpg">--}}
            {{--            </div>--}}
            {{--            <div class="carousel-cell">--}}
            {{--                <img src="https://placeimg.com/640/480/any">--}}
            {{--            </div>--}}
        </div>
    </div>
</div>
    <div class="card flex flex-row justify-center content-center container px-0">
        <!--    left side-->
        <div class="card-left flex w-full flex-col h-full justify-around">
            <h4 class="text-center">Japan to Korea</h4>
            <div class="flex flex-row items-center h-1/3 justify-content-center">
                <img
                    src="images/jap-flag.png"
                    alt="">
                <img
                    src="images/kor-flag.png"
                    alt="">
            </div>

            <p class="card-p" >Delivery within 3 days!</p>
        </div>
        <!--    right side-->
        <div class="">
            <h3 class="">
                <a href="#">
                    <span class="text-2xl">Order For You</span>
                </a>
            </h3>
            <p class="">
                Find the barcode and just let us know. We make the order for you.<br>
                Our specialist will find the best & cheapest shop for the item.
                The delivery will take only 2 to 3 working days to you in KOREA.
            </p>
            <!--        meta information-->
            <div class="card-meta flex">

                <div class="">
                    <a href="/items/search">
                        <img src="images/search.png" alt="search barcode">
                        barcode
                    </a>
                </div>
                <div class="">
                    <a href="#">
                        <img src="images/write.svg"
                             class="mx-1"
                             width="25"
                             height="25"
                             alt="">ask us
                    </a>
                </div>
            </div>
        </div>
    </div>
<div>

    @include('layouts.footer-links')

</div>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>
</html>
