@extends('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">Create Project</h1>
        <form
            action="/projects"
            method="POST"
        >
            @csrf
            <div class="field mb-6">
                <label class="label text-sm block mb-1">Title</label>
                <div class="control">
                    <input
                        type="text"
                        class="input bg-transparent border border-gray-400 rounded p-2 text-xs w-full"
                        id="title"
                        name="title"
                        autofocus>
                </div>
            </div>
            <div class="field mb-6">
                <label for="description" class="label text-sm block mb-1">Description:</label>
                <div class="control">
                <textarea
                    name="description"
                    id="description"
                    rows="10"
                    class="textarea border bg-transparent border-gray-400 rounded p-2 w-full text-sm"
                ></textarea>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button  mr-2 ">Create Project</button>
                    <a href="/projects" class="text-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
