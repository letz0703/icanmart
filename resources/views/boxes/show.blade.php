@extends('layouts.app')

@section('content')
    <box-view :data="{{ $box }}" inline-template :seller="{{ $box->seller }}">
        <div class="">
            <div class="">
                <div class="md:flex">
                    <div class="card flex-1 mr-4">
                        <div class="">
                            <div class="flex flex-col md:my-4 justify-between">
                                <div class="flex justify-between">
                                    <paid-button :payment="paid" class="mr-2"></paid-button>
                                    <div class="mr-3 text-xl text-red-700"> {{ $box->seller->description }}</div>
                                    <span class="flex">{{ $box->arrived_at }}</span>
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
                                <h2 class="md:mt-8 mr-3 text-xl text-2xl text-center">
                                    <a v-text="title"
                                       class=""
                                       @click="$modal.show('edit-box-title')">
                                    </a>


                            <modal name="edit-box-title">
                                <form action="{{ $box->path() }}">
                                        @csrf
                                        @method('patch')
                                    <div class="p-2 text-center">
                                        <input type="text" id="title"
                                               class="text-xl  p-2"
                                               v-model="title"
                                        >
                                        <button class="button bg-blue-400 btn-default" @click.prevent="editTitle">Confirm</button>
                                        <button class="button bg-red-400 mr-4  border rounded-lg shadow"
                                                @click.prevent="$modal.hide('edit-box-title')"
                                        >close</button>
                                    </div>

                                </form>
                            </modal>
                            </h2>
                        </div>
                    </div>
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
                        <h4 class="flex pt-4">합계금액: <span v-text="boxAmount"></span>원</h4>
                        {{--<h4 class="flex">합계금액: {{ $box->amount  }}원</h4>--}}
                        {{--<box-amount  inline-template :attributes="{{ $box }}">--}}
                        {{--<button class="btn btn-info" @click="update">post</button>--}}
                        {{--</box-amount><!---->--}}
                    </div>
                </div>
                {{--@endif--}}
                <div class="flex-1">

                    <div class="card">
                        {{--                            <div class="card-header">{{ $box->title }}</div>--}}
                        <div class="card-body">
                            <div class="mb-2">
                                <h2 class="text-xl">박스금액: <span v-text="boxAmount"></span>원</h2>
                                <article>구입처 : {{ $box->seller->name }}</article>
                                <p>입고일: {{ $box->arrived_at }} ({{ $box->created_at->diffForHumans() }})</p>
                                <p>아이템수: <span v-text="item_count"></span></p>
                            </div>
                            <button class="btn btn-primary btn-sm ml-1"
                                    :class="{ 'btn-danger':locked }"
                                    {{--                                    v-if="authorize('isAdmin')"--}}
                                    @click="toggleLock" v-text="locked?'locked': 'Lock'">
                            </button>

                            <a href="/boxes"
                               class=" btn-sm ml-1 p-2 border border-black ">box list</a>

                            <a href="/boxes/create"
                               class=" btn-sm ml-1 p-2 border border-blue-500 text-blue-700 ">
                                new box</a>
                            <div class="search mt-6">
                                <search></search>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </box-view>
@endsection
