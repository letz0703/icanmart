@extends('layouts.app')

@section('content')
    <header class="mb-6 items-baseline">
        <div class="flex justify-between items-center">
            <p class="text-sm font-normal text-grey">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>
    <div class="flex -mx-3">
        <div class="w-3/4 px-3">
            <div class="section__tasks">
                <h3 class="text-grey mb-3">Tasks</h3>
                @foreach ( $project->tasks as $task)
                    <div class="card mb-3">
                        <form action="{{ $project->path().'/tasks/'.$task->id }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="flex items-center">
                                <input value="{{ $task->body }}" name="body"
                                       class="w-full {{ $task->completed ? 'text-grey line-through':'' }}">
                                <input type="checkbox" name="completed"
                                       onChange="this.form.submit()"
                                    {{ $task->completed ? 'checked':'' }}
                                >
                            </div>
                        </form>
                    </div>
                @endforeach
                <form action="{{ $project->path().'/tasks' }}" method="POST">
                    @csrf
                    <input class="card mb-3 w-full" name="body" placeholder="add new task">
                </form>
            </div>
            <div class="section__general-notes">
                <h3 class="text-grey mb-3">General Notes</h3>
                <form action="{{ $project->path() }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea
                        name="notes"
                        class="card w-full"
                        style="height:9em">{{ $project->notes }}</textarea>
                    <button class="button" type="submit">save</button>
                </form>
            </div>
        </div>
        <div class="lg:w-1/4 px-3 pb-6 py-8">
            <div class="section__project">
                @include('projects.card')
                {{--            <div class="card" style="height:200px">--}}
                {{--                <h2 class="font-normal"><a href="{{ $project->path() }}">{{ $project->title }}</a></h2>--}}
                {{--                <div class="text-grey">{{ Str::limit($project->description,100 )}}</div>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>
@endsection
