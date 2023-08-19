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
            <th>Id</th>
            <th>Key</th>
            <th>name</th>
            <th>Value</th>
            <th>status</th>
            <th>Active</th>


        </tr>
        </thead>
        <tbody>
            @forelse($settings as $setting)
                <tr>
                    <td>{{ $setting->id }}</td>
                    <td>{{ $setting->key }}</td>
                    <td>{{ $setting->name }}</td>
                    <td>{{ $setting->value }}</td>
                    <td>{{ $setting->status }}</td>


                </tr>

            @empty
                <tr>
                    <td colspan="5">No Setting defined.</td>
                </tr>

            @endforelse
        </tbody>
    </table>

{{ $settings->links() }}

@endsection

