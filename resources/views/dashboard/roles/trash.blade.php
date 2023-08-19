@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles Trashed</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success " href="{{ route('dashboard.roles.index') }}"> <i
                        class="nav-icon fas"></i>backe</a>

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
                    <th>Image</th>
                    <th>Status</th>
                    <th>deleted_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->count())
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="img"
                                    style="width: 60px;border-radius: 5px;">
                            </td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->deleted_at }}</td>
                            <td>
                                <div class="btn-group">

                                    <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info mx-2"><strong>Restore</strong></button>
                                    </form>

                                    <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><strong>Delete</strong> </i></button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No Categories</td>
                    </tr>
                @endif

            </tbody>
        </table>


        {{ $categories->withQueryString()->links() }}
    </div>
    </div>
    <!-- /.card-body -->

@endsection

@section('footer')
@endsection

@push('script')
@endpush
