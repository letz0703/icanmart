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
                                <box :data="{{ $box }}" v-cloak></box>
                                <hr>
                            @endforeach
                            {{ $boxes->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Recent View
                        </div>
                        <div class="card-body">
                            Redis Thread here
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </boxes-view>
@endsection
