<div class="card" style="height:200px;">
    <h2 class="font-normal py-3 -ml-5 border-l-4 border-blue-lighter pl-4 mb-3">
        <a href="{{ $project->path() }}">
            {{ $project->title }}
        </a>
    </h2>
    <div class="text-grey">{{ Str::limit($project->description,100) }}</div>
</div>
