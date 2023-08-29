@extends('layouts.dashboard')

@push('style')

@endpush

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0</h3>
                    <p>Orders</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="dashboard/orders" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>0<sup style="font-size: 20px">%</sup></h3>
                    <p>Profits</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sheqel"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>0</h3>
                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="fa fa-product-hunt"></i>
                </div>
                <a href="dashboard/products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>0</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>

                </div>
                <a href="dashboard/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    </div>
@endsection

@section('footer')

@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush









