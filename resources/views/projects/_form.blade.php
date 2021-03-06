@csrf

<div class="field mb-6">
    <label for="title" class="label text-sm block mb-1">Title:</label>
    <div class="control">
        <input
            type="text"
            class="input bg-transparent border border-gray-400 rounded p-2 text-xs w-full"
            id="title"
            name="title"
            value="{{ $project->title }}">
    </div>
</div>
<div class="field mb-6">
    <label for="description" class="label text-sm block mb-1">Description:</label>
    <div class="">
                <textarea
                    name="description" id="description"
                    rows="10"
                    class="textarea border bg-transparent border-gray-400 rounded p-2 w-full text-sm"
                >{{ $project->description }}</textarea>
    </div>
</div>
<div class="field">
    <div class="control">
        <button type="submit" class="button  mr-2 ">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}" class="text-default">Cancel</a>
    </div>
</div>
<div class="field">
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach( $errors->all() as $error)
                <li class="text-red mt-6">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
