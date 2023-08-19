@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success " href="{{ route('dashboard.categories.create') }}"> <i
                        class="nav-icon fas  fa-plus-square"></i> Create Category </a>
                <a href="{{ route('dashboard.categories.trash') }}" class="btn  btn-outline-dark">Trash</a>

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
                    <th>Parent</th>
                    <th>Products #</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->count())
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td> <a href="{{ route('dashboard.categories.show',$category->id) }}">{{  $category->name }}</a></td>
                            <td>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="img"
                                    style="width: 60px;border-radius: 5px;">
                            </td>
                            <td>{{ $category->parent_name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <div class="btn-group">

                                    <button type="button" class="btn btn-info">
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}">
                                            <i class="fas fa-edit" style="color: white"> </i>
                                        </a>
                                    </button>

                                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
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
                        <td colspan="9">No Categories</td>
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
