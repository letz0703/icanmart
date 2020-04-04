@extends('layouts.app')

@section('content')
    <header class="mb-6 items-baseline">
        <div class="flex justify-between items-center">
            <p class="text-sm font-normal text-grey">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <a href="" class="button">New Project</a>
        </div>
    </header>
    <div class="flex -mx-3">
        <div class="w-3/4 px-3">
            <div class="mb-3">
                <h3 class="text-grey mb-3">Tasks</h3>
                @foreach ( $project->tasks as $task)
                    <div class="card mb-3">{{ $task->body }}</div>
                @endforeach
                <form action="">
                    @csrf
                    <input class="card mb-3 w-full" placeholder="add new task">
                </form>
            </div>
            <div>
                <h3 class="text-grey mb-3">General Notes</h3>
                <textarea name="textarea" class="w-full"></textarea>
            </div>
        </div>
        <div class="lg:w-1/4 px-3 pb-6 py-8">
            @include('projects._card')
{{--            <div class="card" style="height:200px">--}}
{{--                <h2 class="font-normal"><a href="{{ $project->path() }}">{{ $project->title }}</a></h2>--}}
{{--                <div class="text-grey">{{ Str::limit($project->description,100 )}}</div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
