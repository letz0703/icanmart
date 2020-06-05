@extends('layouts.app')

@section('content')
    <boxes-view inline-template>
        <div class="container ">
            <header class="flex mb-3 py-2 items-center">
                <h1 class="font-normal px-2 text-2xl">입고목록</h1>
                <a href="/boxes/create"
                   class="btn-text text-sm px-3"
                   @click.prevent="$modal.show('add-box')"
                >New Box</a>
                <modal name="add-box"
                       class="p-4 rounded-lg"
                       height="auto"
                >
                    <div class="container p-10">
                        <h1 class="font-normal text-center text-2xl mb-6">Create Box</h1>
                        <div class="flex">
                            <div class="flex-1 mr-4">
                                <form action="/boxes" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="seller_id">구입처 :</label>
                                        <select name="seller_id" id="seller_id" required>
                                            <option value="">선택</option>
                                            @foreach( $sellers as $seller )
                                                <option value="{{ $seller->id }}"
                                                    {{ old('seller_id') == $seller->id ? 'selected' : '' }}
                                                >{{ $seller->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="arrived_at">입고일: </label>

                                        <input type="date" id="arrived_at" name="arrived_at"
                                               {{--value="{{ old('arrive_at') }}"--}}
                                               value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                            {{--placeholder="{{ \Carbon\Carbon::today() }}"--}}
                                        >
                                    </div>
                                    <div class="mb-4">
                                        <label for="title" class="block">박스요약</label>
                                        <textarea type="text" id="title" name="title"
                                                  class="w-full md:bg-white"
                                                  rows="3"
                                                  value="{{ old('title') }}" required>
                        </textarea>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="paid" id="paid" value=1>
                                        <label class="form-check-label" for="paid">
                                            결제완료
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline form-group">
                                        <input class="form-check-input" type="radio" name="paid" id="paid" value=0
                                               checked>
                                        <label class="form-check-label" for="upaid">
                                            미결제
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">add</button>
                                    </div>
                                </form>
                                @if (count($errors))
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                        </div>
                    </div>
                </modal>
            </header>
            <main class="flex justify-between  -mx-3">

                <div class="w-3/4 px-3">
                    <div class="py-2">
                        @foreach($boxes as $box)
                            <box :data="{{ $box }}" class="card py-3 mb-3" v-cloak></box>
                        @endforeach
                        {{ $boxes->links() }}
                    </div>
                </div>

                <div class="flex-col items-center w-1/4 px-3">
                    <div class="card w-full">
                        <h2 class=" text-center w-full" style="background:aliceblue;">
                            Boxes in Today
                        </h2>
                        <div class="">
                            <ul>
                                @php
                                    $boxesToday = \App\Box::whereDate('created_at',\Carbon\Carbon::today())->get();
                                    $sum = 0;
                                @endphp
                                @foreach($boxesToday as $todayBox)
                                    <li>
                                        <a href="{{ url($todayBox->path()) }}">
                                            {{ $todayBox->seller->description }}/ {{ $todayBox->title }}
                                            / {{ $todayBox->amount }} 원
                                            @php
                                                $sum += $todayBox->amount
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                                {{--                                @foreach($viewed_boxes as $viewed)--}}
                                {{--                                    <li>--}}
                                {{--                                        <a href="{{ url($viewed->path) }}">--}}
                                {{--                                            {{ $viewed->title }}--}}
                                {{--                                        </a>--}}
                                {{--                                    </li>--}}
                                {{--                                @endforeach--}}
                            </ul>
{{--                            <div> 합계:{{ number_format($sum, 0) }}</div>--}}
                            <div class="flex">
                                <span class="mr-3">Total Amount:</span>
                                <span class=" bold text-xl ">@money($sum)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </boxes-view>
@endsection
