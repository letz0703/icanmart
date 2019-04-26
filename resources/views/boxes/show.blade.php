@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $box->title }}</div>

                    <div class="card-body">
                        <article>{{ $box->seller->name }}</article>
                        <p>{{ $box->arrived_at }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Box Items</div>
                    @if (auth()->check())
                        <div class="card-body">
                            <form action="{{ $box->path().'/items' }}" method="POST">
                            @csrf
                                <div class="form-group">
                                    <label for="product_name">제품명:</label>
                                    <input type="text" id="product_name" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">수량:</label>
                                    <input type="text" id="quantity" name="quantity"> 개
                                </div>
                                <div class="form-group">
                                    <label for="buy_price">입고단가:</label>
                                    <input type="text" id="buy_price" name="buy_price"> 원
                                </div>
                                <div class="form-group">
                                    <label for="expire_date">Expire_date:</label>
                                    <input type="date" id="expire_date" name="expire_date" placeholder="Expire_date">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">add</button>
                            </form>
                        </div>
                    @endif
                    <div class="card-body">
                        <div>박스 합계금액: {{ $box->amount  }}</div>
                        @foreach( $items as $item)
                            @include('boxes.item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
