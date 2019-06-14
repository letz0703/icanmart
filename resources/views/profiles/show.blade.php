@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 align-items-center">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                    </h1>
                    <hr>
                </div>
                @foreach($boxes as $box)
                    <div class="card">
                        <div class="level card-header">
                            <span class="flex">
                                {{ $box->title }} Purchased from {{ $box->seller->name }}
                            </span>
                             on {{ $box->created_at->format("Y-m-d") }}
                        </div>

                        @if ($box->items()->exists())
                        <div class="card-body">
                            @foreach($box->items as $item)
                                <span class="btn">{{ $item->product_name }}</span>
                            @endforeach
                        </div>
                            @endif
                    </div>
                @endforeach
                {{ $boxes->links() }}
            </div>
        </div>
    </div>
@endsection
