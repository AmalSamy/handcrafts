@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Question</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success " href="{{ route('dashboard.common_questions.create') }}"> <i
                        class="nav-icon fas  fa-plus-square"></i> Create Question </a>
                <a href="{{ route('dashboard.common_questions.trash')}}" class="btn  btn-outline-dark">Trash</a>

            </div>
            {{-- alert --}}
            <x-alert type="success"/>
            <x-alert type="info"/>

        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" >

            <div class="mt-4 mb-2">
                <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                    <x-form.input name="name" class="mx-2"  placeholder="Name"  :value="request('name')"/>
                    <select name="status" class="form-control mx-2">
                        <option value="">All</option>
                        <option value="active" @selected(request('status') == 'active')>Active</option>
                        <option value="archived" @selected(request('status') == 'archived')>archived</option>
                    </select>
                    <button class="btn btn-dark " style="height: 40px">filter</button>
                </form>
            </div>

            <table class="table table-hover text-nowrap">
                <thead>
                <tr class="table-primary">
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Active</th>


                </tr>
                </thead>
                <tbody>
                @if ($common_questions->count())
                    @foreach ($common_questions as $common_question)
                        <tr>
                            <td>{{ $common_question->id }}</td>
                            <td>{{ $common_question->title }}</td>
                            <td>{{ $common_question->desc }}</td>
                            <td>{{ $common_question->status }}</td>


                            <td>
                                <div class="btn-group">

                                    <button type="button" class="btn btn-info">
                                        <a href="{{ route('dashboard.common_questions.edit', $common_question->id) }}">
                                            <i class="fas fa-edit" style="color: white"> </i>
                                        </a>
                                    </button>

                                    <form action="{{ route('dashboard.common_questions.destroy', $common_question->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"
                                                                                         style="color: white"> </i></button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No Questions</td>
                    </tr>
                @endif

                </tbody>
            </table>


            {{ $common_questions->withQueryString()->links() }}
        </div>
    </div>
    <!-- /.card-body -->

@endsection

@section('footer')
@endsection

@push('script')
@endpush
