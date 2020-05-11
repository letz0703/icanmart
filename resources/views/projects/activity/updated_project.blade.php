@if (count($activity->changes))
    You updated the {{ key($activity->changes['after']) }}
@else
    You updated the project
@endif

