@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>
            {{ $profileUser->name }}
        </h1>
        @foreach($boxes as $box)
            {{ $box->title }}
        @endforeach
    </div>
@endsection
