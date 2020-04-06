@extends('layouts.app')

@section('content')
    <h2>Create Project</h2>
    <form action="/projects" method="POST" class="py-3">
        @csrf
        <div class="flex mb-3">
            <h3 class="mr-2">Title</h3>
            <input type="text" name="title" autofocus>
        </div>
        <h3>Description</h3>
        <textarea name="description" id="description" class="w-full"></textarea>
        <div class="button__group">
            <button class="button mr-3">Create a Project</button>
            <a href="/projects">Cancel</a>
        </div>
    </form>
@endsection
