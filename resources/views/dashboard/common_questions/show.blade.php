@extends('layouts.dashboard')

@section('title', $common_questions->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Commen Question</li>
<li class="breadcrumb-item active">{{ $common_questions->name }}</li>
@endsection

@section('content')

<table class="table table-hover text-nowrap">
    <thead>
        <tr class="table-primary">
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>status</th>

        </tr>
    </thead>
    <tbody>

    @forelse($common_questions as $common_question)
        <tr>
            <td>{{ $common_question->id }}</td>
            <td>{{ $common_question->title }}</td>
            <td>{{ $common_question->desc }}</td>
            <td>{{ $common_question->status }}</td>
        @empty
        <tr>
            <td colspan="5">No products defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $common_questions->links() }}

@endsection

