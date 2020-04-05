<div class="content flex-1">
    <div class="container">
        <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround":true }'>
            <div class="carousel-cell">
                <img src="/images/carousel.jpg">

            </div>
        </div>
    </div>
    {{--    <div class="card flex flex-row justify-around content-center container px-0" style="width:458px">--}}
    <div class="container">
        <div class="flex flex-row px-2 justify-around">
            @include('banner.card-banner',['title'=>'Japan to Korea'])
            {{--        @include('banner.card-banner',['title'=>'Korea to Japan'])--}}
        </div>
    </div>

</div>
