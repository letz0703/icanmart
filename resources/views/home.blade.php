@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 class="">Dashboard</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div>
            You are logged in!
        </div>

    </div>
@endsection
