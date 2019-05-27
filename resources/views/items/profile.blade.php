@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>  {{ $item->product_name }} </h1>
            <hr>
        </div>
        <div class="page-body">
                @foreach($orders as $order)

                        <div>{{ $order->created_at->format('Y-m-d')}}</div>
                        <div> {{ $order->seller->name }} /
                            구입가:
                                {{ $item->buy_price }} 원
                        </div>
                    <hr>
                @endforeach
        </div>

    </div>
@endsection