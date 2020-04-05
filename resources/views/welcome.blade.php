<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-sm md:text-base">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    {{--    <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/bulma">--}}
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/ic.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

</head>
<body>
<div>
    @extends('layouts.app')
    @section('content')
       @include('welcome.202004')
    @endsection
</div>
{{--<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>--}}
{{--<script src="{{asset('js/app.js')}}" defer></script>--}}

</body>
</html>
