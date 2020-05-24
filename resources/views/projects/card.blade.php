<div class="card flex flex-col" style="height:200px;">
    <h2 class="font-normal py-3 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">
        <a href="{{ $project->path() }}">
            {{ $project->title }}
        </a>
    </h2>
    <div class="text-grey flex-1">{{ Str::limit($project->description,100) }}</div>
    <footer>
        <form method="post" action="{{$project->path()}}" class="text-right">
            @method('delete')
            @csrf
            <button type="submit" name="delete" class="text-sm mt-2">Delete</button>
        </form>
    </footer>
</div>
