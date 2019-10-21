@extends('admin.layouts.app')

@section('administration-content')
{{--    <form method="POST" action="{{ route('admin.sellers.store') }}">--}}
    <form method="POST" action="{{ route('admin.sellers.store') }}">
        @include('admin.sellers._form')
    </form>
@endsection
