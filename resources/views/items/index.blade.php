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
                                <div class="level">
                                    <a href="{{ $item->path() }}" class="flex">
                                        <h5>{{ $item->product_name }} ({{ $item->seller->name }}
                                            ) {{ $item->created_at }}</h5>
                                    </a>
                                    <div> 바코드 : {{ $item->barcode }}</div>
                                </div>
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
