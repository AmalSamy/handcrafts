@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                 <a class="btn btn-success " href="{{ route('dashboard.products.create') }}"> <i
                         class="nav-icon fas  fa-plus-square"></i> Create Prouducts </a>
                 <a href="{{ route('dashboard.products.trash') }}" class="btn  btn-outline-dark">Trash</a>

            </div>
            <br>
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
                    <th>Category</th>
                    <th>store</th>
                    <th>is_visible</th>
                    <th>slug</th>
                    <th>delivery_period</th>
                    <th>image</th>
                    <th>price</th>
                    <th>compare_price</th>
                    <th>opations</th>
                    <th>rating</th>
                    <th>featured</th>
                    <th>status</th>
                    <th>Active</th>

                </tr>
            </thead>
            <tbody>
                @if ($products->count())
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->Category->name}}</td>
                            <td>{{ $product->store->name }}</td>
                            <td>{{ $product->is_visible }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->delivery_period }}</td>
                            <td><img src="{{ asset('storage/' . $product->image) }}" height="50px" width="50px"></td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->compare_price }}</td>
                            <td>{{ $product->opations }}</td>
                            <td>{{ $product->rating }}</td>
                            <td>{{ $product->featured }}</td>
                            <td>{{ $product->status }}</td>

                            <td>
                                <div class="btn-group">

                                    <button type="button" class="btn btn-info">
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}">
                                            <i class="fas fa-edit" style="color: white"> </i>
                                        </a>
                                    </button>

                                    <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
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
                        <td colspan="9">No products</td>
                    </tr>
                @endif

            </tbody>
        </table>


        {{ $products->withQueryString()->links() }}
    </div>
    </div>
    <!-- /.card-body -->

@endsection

@section('footer')
@endsection

@push('script')
@endpush
