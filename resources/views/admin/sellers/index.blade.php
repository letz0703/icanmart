@extends('admin.layouts.app')
@section('administration-content')
    <p>
        <a href="{{ route('admin.sellers.create') }}" class="btn btn-primary btn-sm">New Sellers<sup>+</sup></a>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>phone</th>
            <th>Boxes</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($sellers as $seller)
            <tr>
                <td>{{ $seller->name }}</td>
                <td>{{ $seller->slug }}</td>
                <td>{{ $seller->description }}</td>
                <td>{{ $seller->phone }}</td>
                <td>{{ count($seller->boxes) }}</td>
            </tr>
        @empty
            <tr>
                <td>Nothing here.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
