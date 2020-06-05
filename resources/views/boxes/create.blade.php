@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="font-normal text-center text-2xl mb-6">Create Box</h1>
        <div class="flex">
            <div class="">
                @include(boxes.form.boxForm)

                @if (count($errors))
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
