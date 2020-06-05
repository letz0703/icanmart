@extends('admin.layouts.app')
@section('administration-content')
    <div class="flex flex-col md:w-full">
        <div class="flex items-baseline justify-between">
            <h1 class="text-2xl mb-5">거래처 리스트</h1>
            <a href="{{ route('admin.sellers.create') }}"
               class="btn btn-primary btn-sm">New Sellers<sup>+</sup></a>
        </div>
        <table class="table">
            <thead>
            <tr class="border">
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>phone</th>
                <th>Boxes</th>
                <th>Edit</th>
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
                    <td>
                        <a href="{{ route('admin.sellers.edit',$seller->slug) }}"
                           class="btn btn-sm">Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Nothing here.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
