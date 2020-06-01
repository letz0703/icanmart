@extends('layouts.app')

@section('content')
    @if(auth()->user() && auth()->user()->isAdmin)
        @include('manage')
    @endif
    <div class="card">
        <h2 class="">Dashboard</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-4">
            You are logged in!
        </div>
        @include('layouts.section-feature')


    </div>
@endsection
