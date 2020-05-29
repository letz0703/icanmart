@extends('layouts.app')

@section('content')
    <div class="">
        <modal name="hello-world2" height="auto">modal text</modal>
        <a href="" @click.prevent="$modal.show('hello-world2')">show</a>
        <br>
    </div>
@endsection
