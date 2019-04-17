@extends('layouts.app')
@section('content')
    @foreach($items as $item)
        <ul>
            <li>{{ $item->product_name }}</li>
        </ul>
    @endforeach
@endsection
