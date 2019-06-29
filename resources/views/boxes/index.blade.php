@extends('layouts.app')

@section('content')
    <boxes-view inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Boxes</div>
                    <div class="card-body">
                        @foreach($boxes as $box)
                            <box :data="{{ $box }}" v-cloak>
                            {{--<div class="level">--}}
                                {{--<div class="flex">--}}
                                    {{--<a href="{{ $box->path() }}">--}}
                                        {{--{{ $box->arrived_at }}--}}
                                        {{--{{ $box->seller->name }}:--}}
                                    {{--</a>--}}
                                    {{--@can('update')--}}
                                    {{--<span v-if="paid">--}}
                                        {{--<button class="btn btn-primary btn-sm" @click="unpaid">paid</button>--}}
                                    {{--</span>--}}
                                    {{--<span v-else>--}}
                                            {{--<button class="btn btn-danger btn-sm" @click="make">unpaid</button>--}}
                                    {{--</span>--}}
                                    {{--@endcan--}}
                                        {{--{{ $box->title }} [--}}
                                    {{--@if ($box->paid)--}}
                                        {{--paid--}}
                                    {{--@else--}}
                                        {{--<span style="color:red;">unpaid</span>--}}
                                    {{--@endif--}}
                                    {{--]--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--{{ $box->items_count }}--}}
                                    {{--{{ str_plural('item',$box->items_count) }}--}}
                                    {{--[ total: {{ $box->amount }} 원 ]--}}
                                {{--</div>--}}

                            {{--</div>--}}

                            </box>
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
    </boxes-view>
@endsection
