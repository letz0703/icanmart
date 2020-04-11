@extends('layouts.app')

@section('content')
    <boxes-view inline-template>
        <div class="container">
            <header class="flex mb-3 -mx-3 py-2 items-center justify-between">
                <h2 class="font-normal px-3">Boxes</h2>
                <a href="/boxes/create" class="button text-sm px-3">New Box</a>
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
                            Recent View
                        </h2>
                        <div class="">
                            <ul>
                                @foreach($viewed_boxes as $viewed)
                                    <li>
                                        <a href="{{ url($viewed->path) }}">
                                            {{ $viewed->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            </main>
        </div>
    </boxes-view>
@endsection
