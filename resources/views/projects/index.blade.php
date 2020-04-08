@extends('layouts.app')

@section('content')
    <header class="mb-6">
        <div class="flex justify-between items-baseline">
            <h2 class="">My Projects</h2>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>
    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <p>No Project yet</p>
        @endforelse
    </div>
@endsection
