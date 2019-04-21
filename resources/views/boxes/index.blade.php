@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Boxes</div>

                    <div class="card-body">
                        @foreach($boxes as $box)
                            <p> {{ $box->arrived_at }}</p>
                            <article>{{ $box->title }} {{ $box->amount }}</article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
