<ul>
    @foreach ($project->activities as $activity)
        <li class="text-sm {{ $loop->last?'':'mb-1' }}">
            @include("projects.activity.{$activity->description}")
        </li>
    @endforeach
</ul>
