@extends('layouts.app')

@section('content')
    <box-view :data="{{ $box }}" inline-template :seller="{{ $box->seller }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <paid-button :payment="paid" class="mr-2"></paid-button>
                                <span class="mr-3"> {{ $box->title }}</span>
                                <span class="flex">
                            {{ $box->arrived_at }} {{ $box->seller->name }}
                        </span>

                                {{--@if ($box->paid)--}}
                                {{--paid--}}
                                {{--@else--}}
                                {{--<span style="color:red;">unpaid</span>--}}
                                {{--@endif--}}

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
                                    {{--                                    <div>--}}
                                    {{--                                        <a href="/items/create"><button type="text">Add Item</button></a>--}}
                                    {{--                                    </div>--}}
                                @endcan
                            </div>
                        </div>
                        {{--                        @if (auth()->check())--}}
                        {{--<div class="card-body">--}}
                        {{--@include('boxes.form.itemForm')--}}
                        {{--</div>--}}
                        <div class="card-body">
                            <items :box-amount="{{ $box->amount }}" :box-id="{{ $box->id }}"
                                   :seller="{{ $box->seller }}"
                                   :box-locked="locked"
                                   @reduce="reduceBoxAmount" @item-added="addAmount"></items>

                            {{--<h2>Box Items</h2>--}}
                            {{--<hr>--}}
                            {{--@php--}}
                            {{--$box->amount = 0;--}}
                            {{--@endphp--}}
                            {{--@foreach( $items as $item)--}}
                            {{--@include('boxes.item')--}}
                            {{--@php--}}
                            {{--$box->amount += $item->amount;--}}
                            {{--@endphp--}}
                            {{--@endforeach--}}
                            {{--<hr>--}}
                            {{--<div class="level">--}}
                            <h4 class="flex">합계금액: <span v-text="boxAmount"></span></h4>
                            {{--<h4 class="flex">합계금액: {{ $box->amount  }}원</h4>--}}
                            {{--<box-amount  inline-template :attributes="{{ $box }}">--}}
                            {{--<button class="btn btn-info" @click="update">post</button>--}}
                            {{--</box-amount><!---->--}}
                        </div>
                    </div>
                    {{--@endif--}}
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ $box->title }}</div>
                        <div class="card-body">
                            <h4>박스금액: <span v-text="boxAmount"></span>원</h4>
                            <article>구입처 : {{ $box->seller->name }}</article>
                            <p>입고일: {{ $box->arrived_at }} ({{ $box->created_at->diffForHumans() }})</p>
                            <p>아이템수: <span v-text="item_count"></span></p>
                            <button class="btn btn-primary btn-sm ml-1"
                                    :class="{ 'btn-danger':locked }"
{{--                                    v-if="authorize('isAdmin')"--}}
                                    @click="toggleLock" v-text="locked?'locked': 'Lock'">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </box-view>
@endsection
