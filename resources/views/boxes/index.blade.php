@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Boxes</div>

                    <div class="card-body">
                        @foreach($boxes as $box)
                            <div class="level">
                                <div class="flex">
                                    <a href="{{ $box->path() }}">
                                        {{ $box->arrived_at }}
                                        {{ $box->seller->name }}:
                                    </a>
                                        {{ $box->title }}
                                </div>
                                <div>
                                    {{ $box->items_count }}
                                    {{ str_plural('item',$box->items_count) }}
                                    [ total: {{ $box->amount }} 원 ]
                                </div>
                            </div>

                                <div>
                                    @foreach($box->items as $item)
                                        {{ $item->product_name }}
                                    @endforeach
                                </div>
                            <hr>
                        @endforeach
                        {{ $boxes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
