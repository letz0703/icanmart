@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $item->product_name }}</div>
                    <div class="card-body">
                        <article>
                            <h5> {{ $item->product_name }} - {{ $item->sell_price }} 원</h5>
                            <div>{{ $item->description }}</div>
                            <hr>
                            <p> 유통기한 {{ $item->expire_date }}</p>
                            <div>판매가 : {{ $item->sell_price }} 원</div>
                            <div>입고가 : {{ $item->buy_price }} 원</div>
                            <div>입고수량 : {{ $item->quantity }} 개</div>
                            <div>합계액 : {{ $item->quantity * $item->buy_price }} 원</div>
                            <div>마진: {{ $item->sell_price - ($item->buyprice) }} 원</div>
                            <div>기대수익: {{ ($item->sell_price - $item->buyprice)*$item->quantity }} 원</div>
                        </article>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
