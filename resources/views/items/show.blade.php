@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>
                        {{ $item->product_name }}
                        </h2>
                        ({{ $item->box->arrived_at }} 입고)
                        @if($item->barcode)바코드: {{ $item->barcode }} @endif
                    </div>
                    <div class="card-body">
                        <article>
                            <h5>구입처: {{ $item->seller->name }}</h5>
                            <h5>판매가:
                                @if ($item->sell_price)
                                    {{ $item->sell_price }} 원
                                @else
                                    입력요함
                                    {{--<form action="/items" method="POST">--}}
                                    {{--@csrf--}}
                                    {{--<input type="text" id="sell_price" name="sell_price"--}}
                                    {{--placeholder="판매가">--}}
                                    {{--<button type="submit" class="btn btn-default">입력</button>--}}
                                    {{--</form>--}}
                                @endif
                            </h5>
                            {{--<div>{{ $item->description }}</div>--}}
                            <p> 유통기한 {{ $item->expire_date }}</p>
                            <hr>
                            @if (auth()->check())
                            <h4 style="color:green;">사입가 : {{ $item->buy_price}}</h4>
                            <div>입고수량 :{{ $item->quantity }} 개</div>
                            <div>합계액 : {{ $item->amount }} 원</div>
                            @php
                                $margin = $item->sell_price - $item->buy_price;
                                $profit = $margin*$item->quantity;
                                $profit_rate = $margin/$item->buy_price*100;
                            @endphp
                            <div>마진: {{ $margin }} 원</div>
                            <h3> 기대수익: {{ $profit }} 원 [ {{ $profit_rate}} % ]</h3>
                                @endif
                        </article>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
