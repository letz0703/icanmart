@extends('layouts.app')

@section('content')
    <boxes-view inline-template>
        <div class="flex flex-row justify-center container">
            <div class="col-md-8 md-9 mr-6">
                <div class="card-header">Boxes</div>
                <div class="card-body">
                    @foreach($boxes as $box)
                        <box :data="{{ $box }}" v-cloak></box>
                        <hr>
                    @endforeach
                    {{ $boxes->links() }}
                </div>
            </div>

            <div class="col-md-2 flex flex-col items-center justify-center">
                <div class="text-xl text-center" style="background:aliceblue;">
                    Recent View
                </div>
                <div class="card-body flex flex-row">
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
@endsection
