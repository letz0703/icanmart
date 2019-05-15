@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Boxes</div>

                    <div class="card-body">
                        {{--@php--}}
                            {{--$boxes->paginate(1)--}}
                        {{--@endphp--}}
                        @foreach($boxes as $box)
                            <p>입고일: {{ $box->arrived_at }}</p>
                        <a href="{{ $box->path() }}">
                            <article>{{ $box->title }} {{ $box->amount }}</article>
                        </a>
                            <hr>
                        @endforeach
                        {{ $boxes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
