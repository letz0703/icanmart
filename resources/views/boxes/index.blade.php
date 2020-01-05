@extends('layouts.app')

@section('content')
    <boxes-view inline-template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-header">Boxes</div>
                    <div class="container">
                        <div class="card-body">
                            @foreach($boxes as $box)
                                <box :data="{{ $box }}" v-cloak></box>
                                <hr>
                            @endforeach
                            {{ $boxes->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card flex-column">
                        <div class="card-header">
                            Recent View
                        </div>
                        <div class="card-body">
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
            </div>
        </div>
    </boxes-view>
@endsection
