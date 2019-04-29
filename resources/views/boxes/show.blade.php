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
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Box Items</div>
                    @if (auth()->check())
                        <div class="card-body">
                            @include('boxes.form.itemForm')
                        </div>
                        <div class="card-body">
                            @php
                                $box->amount = 0;
                            @endphp
                            @foreach( $items as $item)
                                @include('boxes.item')
                                @php
                                    $box->amount += $item->amount;
                                @endphp
                            @endforeach
                            <h4>박스 합계금액: {{ $box->amount  }}원</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
