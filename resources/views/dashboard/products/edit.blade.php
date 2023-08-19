@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit product</li>
@endsection



@section('style')
@endsection

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create product</h3>
            </div> <!--end header -->
            <!-- form start -->
                <form action="{{ route('dashboard.products.update',$product->id)}}" method="post" style="" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('dashboard.products._form',['buttom_lapel'=>'Update'])

                </form>

        </div> <!--end card -->
    </div> <!--end content -->
@endsection

@section('script ')
@endsection
