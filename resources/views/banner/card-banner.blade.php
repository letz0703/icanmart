<div class="card mx-2 w-1/2 p-2 pl-3">
    <div class="container mx-auto flex flex-row p-0">
        <!--    left side-->
        {{--            <div class="card-left flex flex-col h-full items-center justify-around ">--}}
        <div class="card-left flex flex-col pt-3 justify-around">
            <h3 class="text-center w-48 leading-none">{{ $title }}</h3>
            <div class="flex flex-row items-center justify-center">
                <img
                    src="images/jap-flag.png"
                    alt="">
                <img
                    src="images/kor-flag.png"
                    alt="">
            </div>

            <p class="text-center text-gray-200">Delivery within 3 days!</p>
        </div>
        <!--    right side-->
        {{--            <div class="flex flex-col ml-4 mr-2 mt-4 justify-between leading-none">--}}
        <div class="flex flex-col justify-between mx-auto pt-4 leading-none w-1/2">
            <h3 class="leading-none">Order For You</h3>
            <p class="text-gray-600 text-left text-wrap leading-snug">
                Find the barcode and just let us know. We make the order for you.<br>
                Our specialist will find the best & cheapest shop for the item.
                The delivery will take only 2 to 3 working days to you in KOREA.
            </p>
            <!--        meta information-->
            <div class="card-meta flex justify-start pb-6 pl-2">

                <div class="">
                    <a href="/items/search">
                        <img src="images/search.png" alt="search barcode">
                        barcode
                    </a>
                </div>
                <div>
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
</div>
