@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <form method="get" action="/items/search">
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="query"
                                   placeholder="Search for Item"
                            >
                            <button type="submit" class="btn btn-outline-info btn-sm">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($items as $item)
                                {{--                                <a href="{{ url($item->path) }}">--}}
                                <li class="list-group-item">
                                    <a href="{{ url($item->path()) }}">
                                        {{ $item->product_name }} {{ $item->sell_price }}[ <sup>{{ $item->buy_price }}</sup> ]
                                    </a>
                                </li>
                                {{--                                </a>--}}
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
