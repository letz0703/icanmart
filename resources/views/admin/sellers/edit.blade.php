@extends('admin.layouts.app')
@section('administration-content')
    <form method="POST" action="{{ route('admin.sellers.update',$seller->slug) }}">
        {{ method_field('PATCH') }}
        @include('admin.sellers._form',['buttonText'=>'Update Seller'])
    </form>
@endsection
