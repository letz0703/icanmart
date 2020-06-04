@extends('layouts.app')
@section('content')
    <div class="row flex justify-center">
        <div class="md:col-md-8">
            <div class="card-body">
                <search ref="search"></search>
            </div>
            <div class="card-header mt-5 text-xl mb-5 bg-blue-200">
                최근 도착 상품
            </div>

            <div class=" flex justify-center">
                <div class="card-body">
                    <ul class="list-group flex-1">
                        @foreach($items as $item)
                            <li class="list-group-item text-left mb-2">
                                <span class="mr-4">{{ $item->updated_at->toDateString() }}</span>
                                <a href="{{ url($item->path()) }}">
                                    {{ $item->description }} / {{ $item->sell_price }}원
                                    @can('update')
                                        [
                                        <sup>{{ $item->buy_price }}</sup> ]
                                    @endcan
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
