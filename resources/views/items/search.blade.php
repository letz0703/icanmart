@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
{{--                <app></app>--}}
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($items as $item)
{{--                                <a href="{{ url($item->path) }}">--}}
                                    <li class="list-group-item">{{ $item->product_name }}</li>
{{--                                </a>--}}
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
