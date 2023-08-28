@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success " href="{{ route('dashboard.roles.create') }}"> <i
                        class="nav-icon fas  fa-plus-square"></i> Create Role </a>

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
                    <th>Name</th>
                    <th>Created_at</th>

                </tr>
            </thead>
            <tbody>
                @if ($roles->count())
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <div class="btn-group">

                                    <button type="button" class="btn btn-info">
                                        <a href="{{ route('dashboard.roles.edit', $role->id) }}">
                                            <i class="fas fa-edit" style="color: white"> </i>
                                        </a>
                                    </button>

                                    <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
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
                    </tr>
                @endif

            </tbody>
        </table>


    </div>
    </div>
    <!-- /.card-body -->

@endsection

@section('footer')
@endsection

@push('script')
@endpush
