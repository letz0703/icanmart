@extends('layouts.app')

@section('content')
    <header class="mb-6">
        <div class="flex justify-between items-baseline">
            <h2 class="">My Projects</h2>
            <a href="" class="bg-blue rounded-lg px-3 py-1 text-white">New Project</a>
        </div>
    </header>
    <div class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="card" style="height:200px">
                    <h2 class="font-normal">{{ $project->title }}</h2>
                    <div class="text-grey">{{ Str::limit($project->description,100 )}}</div>
                </div>
            </div>
        @empty
            <p>No Project yet</p>
        @endforelse
    </div>
@endsection
