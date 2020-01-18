@extends('layouts.app')
@section('content')
    <div class="md:container mx-auto">
        <div class="row flex justify-center">
            <div class="md:col-md-8">
                <div class="card-body">
                    <search ref="search"></search>
                    {{--                    <form method="get" action="/items/search">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <input type="text"--}}
                    {{--                                   class="form-control"--}}
                    {{--                                   name="query"--}}
                    {{--                                   placeholder="Search for Item"--}}
                    {{--                            >--}}
                    {{--                            <button type="submit" class="btn btn-outline-info btn-sm">--}}
                    {{--                                Search--}}
                    {{--                            </button>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
                </div>
                {{--                <div class="card">--}}
                <div class="card-header">
                    Newly Arrived Items
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($items as $item)
                            {{--                            <a href="{{ url($item->path) }}">--}}
                            <li class="list-group-item">
                                <a href="{{ url($item->path()) }}">
                                    {{ $item->description }} / {{ $item->sell_price }}원
                                    @can('update')
                                        [
                                        <sup>{{ $item->buy_price }}</sup> ]
                                    @endcan
                                </a>
                            </li>
                            {{--                            </a>--}}
                        @endforeach
                    </ul>
                </div>
            </div>
            {{--            </div>--}}
        </div>
    </div>
@endsection
