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
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 4em;
            font-weight: 200;
        }

        .links > a {
            color: #636b6f;
            padding: 1em 1em;
            font-size: 1.2em;
            font-weight: 300;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
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

    <div class="content" style="width:640px">
        <div class="flex-1 text-2xl mb-22">
            {{ env('APP_NAME') }}
        </div>
        <div class="container" style="width:640px;height:300px;">
            <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround":true }'>
                <div class="carousel-cell" style="width:640px; height:300px">
                    <img src="/images/carousel.jpg">
                </div>
                <div class="carousel-cell" style="width:640px; height:300px">
                    <img src="/images/carousel-img-blendy.jpg">
                </div>
{{--                <div class="carousel-cell" style="width:640px; height:400px">--}}
{{--                    <img src="https://placeimg.com/640/480/any?4">--}}
{{--                </div>--}}
{{--                <div class="carousel-cell" style="width:640px; height:400px">--}}
{{--                    <img src="https://placeimg.com/640/480/any?5">--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="links mb-3 pt-8 text-sm">
            <a href="items/search">제품검색</a>
            @can('update')
                <a href="boxes/create">입고등록</a>
                <a href="items/create">아이템등록</a>
            @endcan
        </div>

    </div>
</div>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>
</html>
