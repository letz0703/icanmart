@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-2">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-normal">My Projects</h2>
            <a href="/projects/create" class="button" style="">New Project</a>
        </div>
    </header>
    <main class="lg:flex flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No Projects Yet</div>
        @endforelse
    </main>
    <modal name="hell-world" height="auto">hello world</modal>
    <a href="" @click.prevent="$modal.show('hello-world')">show modal</a>
@endsection
