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
                <div class="card">
                    <div class="card-header">Box Items</div>

                    <div class="card-body">
                        @foreach( $items as $item)
                            @include('boxes.item')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
