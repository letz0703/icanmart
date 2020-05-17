@if (count($activity->changes))
    {{ $activity->owner }} updated the {{ key($activity->changes['after']) }}
@else
    {{ $activity->owner }} updated the project
@endif

