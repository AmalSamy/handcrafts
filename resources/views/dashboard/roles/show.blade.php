@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">{{ $role->name }}</li>
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

        @forelse($roles as $role)
        <tr>
            <td>{{ $product->role }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No products defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}

@endsection

