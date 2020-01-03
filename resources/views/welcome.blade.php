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
<div>

    @include('layouts.footer-links')

</div>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>
</html>
