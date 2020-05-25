@if ($errors->{$bag ?? 'default'}->any())
    <div class="field mt-4">
        <ul>
            @foreach( $errors->{ $bag ?? 'default' }->all() as $error)
                <li class="text-red-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

