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
            <a href="items/search">Search Items</a>
            @can('update')
                <a href="/nova">Nova</a>
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
<div class="ic-card">
    <div class="card">
        <!--    left side-->
        <div class="card-left">

            <div class="flex">
                <img
                    class="flex-1"
                    src="https://conceptdraw.com/a1975c3/p3/preview/640/pict--japan-fifa-world-cup-2014-team-flags---vector-stencils-library.png--diagram-flowchart-example.png"
                    alt="">
                <img
                    class="flex-1"
                    src="https://conceptdraw.com/a1975c3/p4/preview/640/pict--south-korea-fifa-world-cup-2014-team-flags---vector-stencils-library.png--diagram-flowchart-example.png"
                    alt="">
            </div>
            <div class="pt-2">
                <h4 class="card-title">Japan to Korea</h4>

            </div>
            <p>3 Days Delivery</p>
        </div>
        <!--    right side-->
        <div class="card-right">
            <h3 class="card-title">
                <a href="#">
                    Oder for you
                </a>
            </h3>
            <p class="card-excerpt">
                Find the barcode and just let us know. We make the order for you.<br>
                Our specialist will find the best & cheapest shop for the item.
                The delivery will take only 2 to 3 working days to you in KOREA.
            </p>
            <!--        meta information-->
            <div class="flex">
                <a href="/item/search">
                    <div class="flex-img-container">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"
                             aria-labelledby="search" role="presentation"
                             {{--                 class="fill-current absolute search-icon-center ml-3 text-80">--}}
                             class="mx-1 flex">
                            <path fill-rule="nonzero"
                                  d="M14.32 12.906l5.387 5.387a1 1 0 0 1-1.414 1.414l-5.387-5.387a8 8 0 1 1 1.414-1.414zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"
                            ></path>
                        </svg>
                        barcode
                    </div>
                </a>
                <a href="#">
                    <div class="flex-img-container">
                        <img src="https://cdn.shopify.com/s/files/1/0066/7670/9461/t/13/assets/index-order.svg?15994"
                             class="mx-1"
                             width="25"
                             height="25"
                             alt="">inform us
                    </div>
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
