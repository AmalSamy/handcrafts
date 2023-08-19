@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Products</li>
@endsection



@section('style')
@endsection

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Product</h3>
            </div> <!--end header -->
            <!-- form start -->
                <form action="{{ route('dashboard.products.store')}}" method="post" style="" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.products._form')

                </form>

        </div> <!--end card -->
    </div> <!--end content -->
@endsection

@section('script ')
@endsection
