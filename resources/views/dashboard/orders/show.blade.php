@extends('layouts.dashboard')

@section('title', $order->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">orders</li>
<li class="breadcrumb-item active">{{ $order->name }}</li>
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

        @forelse($products as $product)
        <tr>
            <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
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

