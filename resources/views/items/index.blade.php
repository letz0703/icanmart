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
                                    <h5>{{ $item->product_name }}- {{ $item->sell_price }} 원</h5>
                                </a>
                                <div>{{ $item->description }}</div>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
