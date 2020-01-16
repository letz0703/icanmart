@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <boxes-view inline-template class="">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="flex-1">
                    <div class="card-header">Boxes</div>
                    <div class="card-body">
                        @foreach($boxes as $box)
                            <box :data="{{ $box }}" v-cloak></box>
                            <hr>
                        @endforeach
                        {{ $boxes->links() }}
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center">
                    <div class="text-xl text-center" style="background:aliceblue;">
                        Recent View
                    </div>
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
            </div>
        </boxes-view>
    </div>
@endsection
