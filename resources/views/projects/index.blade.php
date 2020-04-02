@extends('layouts.app')

@section('content')
    <h2>My Projects</h2>
    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="card" style="height:200px">
                    <h2>{{ $project->title }}</h2>
                    <div>{{ Str::limit($project->description,100 )}}</div>
                </div>
            </div>
        @empty
            <p>No Project yet</p>
        @endforelse
    </div>
@endsection
