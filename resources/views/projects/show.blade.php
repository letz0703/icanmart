@extends('layouts.app')

@section('content')
    <header class="mb-6">
        <div class="flex justify-between items-baseline">
            <h2 class="">{{ $project->title }}</h2>
            <a href="" class="button">New Project</a>
        </div>
    </header>
    <div class="flex -mx-3">
        <div class="w-3/4 px-3">
            <div class="mb-3">
                @foreach ( $project->tasks as $task)
                    <h3 class="text-grey mb-3">{{ $task->body }}</h3>
                @endforeach
                <input type="text" class="card mb-3 w-full" placeholder="add new task">

                <div class="card mb-3">go to store</div>
                {{--                @foreach ($project->tasks as $task)--}}
                {{--                    {{ $task->body }}--}}
                {{--                @endforeach--}}

            </div>
            <div>
                <h3 class="text-grey mb-3">General Notes</h3>
                <textarea name="textarea" class="w-full"></textarea>
            </div>
        </div>
        <div class="lg:w-1/3 px-3 pb-6 py-10">
            <div class="card" style="height:200px">
                <h2 class="font-normal"><a href="{{ $project->path() }}">{{ $project->title }}</a></h2>
                <div class="text-grey">{{ Str::limit($project->description,100 )}}</div>
            </div>
        </div>
    </div>
@endsection
