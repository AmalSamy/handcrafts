@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')

<table class="table table-hover text-nowrap">
    <thead>
        <tr class="table-primary">
            <th></th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @php
            $category = $category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse($products as $product)
        <tr>
            <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->store->name }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No $category defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $category->links() }}

@endsection

