@csrf
<div class="field ">
    <label>Title:</label>
    <div class="control">
        <input type="text" id="title" name="title" value="{{ $project->title }}" required autofocus>
    </div>
</div>
<div class="field">
    <label for="description">Description:</label>
    <div class="control">
        <textarea name="description" id="description" rows="4"
                  required>{{ $project->description }}</textarea>
    </div>
</div>
<div class="field">
    <div class="control">
        <button type="submit" class="button  mr-2">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}" class="text-default">Cancel</a>
    </div>
</div>
@if ($errors->any())
    <div class="mt-4">
        <ul>
            @foreach( $errors->all() as $error)
                <li class="tred">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
