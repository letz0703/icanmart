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
                                    아이템:
                                    <input type="text" id="product_name" name="product_name">
                                    수량:
                                    <input type="text" id="quantity" name="quantity">
                                    가격:
                                    <input type="text" id="buy_price" name="buy_price">
                                    <button type="submit">add</button>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card-body">
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
