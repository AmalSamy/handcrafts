@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Role</li>
@endsection



@section('style')
@endsection

@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Roles</h3>
            </div> <!--end header -->
            <!-- form start -->
                <form action="{{ route('dashboard.roles.store')}}" method="post" style="" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.roles._form')

                </form>

        </div> <!--end card -->
    </div> <!--end content -->
@endsection

@section('script ')
@endsection


