@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Items</div>
                    <div class="card-body">
                        @foreach($items as $item)
                            <article>
                                <a href="{{ $item->path() }}">
                                    <h5>{{ $item->product_name }} ({{ $item->seller->name }}) {{ $item->created_at }}</h5>
                                </a>
                                <div>{{ $item->quantity }} x {{ $item->buy_price }} = {{ $item->amount }} 원</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
