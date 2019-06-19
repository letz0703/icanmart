@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                        <span class="flex">
                            {{ $box->arrived_at }} {{ $box->seller->name }} [
                            @if ($box->paid)
                                paid
                            @else
                                <span style="color:red;">unpaid</span>
                            @endif
                            ]
                        </span>
                            @can('update', $box)
                                <div>
                                    <form action="{{ $box->path() }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete Box
                                        </button>
                                    </form>
                                </div>
                            @endcan
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
                            <div class="level">
                            <h4 class="flex">합계금액: {{ $box->amount  }}원</h4>
                            <box-amount  inline-template :attributes="{{ $box }}">
                                <button class="btn btn-info" @click="update">post</button>
                            </box-amount>
                            </div>
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
@endsection
