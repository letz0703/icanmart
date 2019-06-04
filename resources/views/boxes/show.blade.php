@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            {{ $box->arrived_at }} {{ $box->seller->name }}
                        </span>
                        <div>
                            @can('update', $box)
                            <form action="{{ $box->path() }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-sm">
                                    Delete Box
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                    </div>
                    @if (auth()->check())
                        <div class="card-body">
                            @include('boxes.form.itemForm')
                        </div>
                        <div class="card-body">
                            <h2>Box Items</h2>
                            <hr>
                            @php
                                $box->amount = 0;
                            @endphp
                            @foreach( $items as $item)
                                @include('boxes.item')
                                @php
                                    $box->amount += $item->amount;
                                @endphp
                            @endforeach
                            <hr>
                            <h4>합계금액: {{ $box->amount  }}원</h4>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ $box->title }}</div>

                    <div class="card-body">
                        <h4>합계금액: {{ $box->amount  }}원</h4>
                        <article>구입처 : {{ $box->seller->name }}</article>
                        <p>입고일: {{ $box->arrived_at }} ({{ $box->created_at->diffForHumans() }})</p>
                        <p>아이템수: {{ $box->items()->count() }}</p>
                    </div>
                </div>
            </div>

        </div>


    </div>
    </div>
@endsection
