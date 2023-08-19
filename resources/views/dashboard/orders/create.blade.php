@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Orders</li>
@endsection



@section('style')
@endsection

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Orders</h3>
            </div> <!--end header -->
            <!-- form start -->
                <form action="{{ route('dashboard.orders.store')}}" method="post" style="" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.orders._form')

                </form>

        </div> <!--end card -->
    </div> <!--end content -->
@endsection

@section('script ')
@endsection


