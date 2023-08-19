@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

<x-alert type="success" />

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary" style="padding: 15px">
        <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
        </div> <!--end header -->
        <!-- form start -->

            <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-row">
                    <div class="col-md-6">
                        <x-form.input name="name" label=" Name" :value="$user->profile->name" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-form.label id="image"> Image: </x-form.label>
                            <x-form.input type="file" name="image" placeholder="image" accept="image/*" />
                            @if ($user->profile->img_profile)
                            <img src="{{ asset('storage/'.$user->profile->img_profile) }}" alt="img" style="width: 40px;border-radius: 5px;">
                            @endif
                        </div>
                        {{-- <x-form.input name="img_profile" label=" Img profile" :value="$user->profile->img_profile" /> --}}
                    </div>


                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile->birthday" />
                    </div>
                    <div class="col-md-6">
                        <x-form.radio name="gender" label="Gender" :options="['male'=>'Male', 'female'=>'Female']" :checked="$user->profile->gender" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <x-form.input name="street_address" label="Street Address" :value="$user->profile->street_address" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="city" label="City" :value="$user->profile->city" />
                    </div>
                    <div class="col-md-4">
                        <x-form.input name="state" label="State" :value="$user->profile->state" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile->country" />
                    </div>
                    <div class="col-md-4">
                        <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->profile->locale" />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Save</button>
            </form>


    </div> <!--end card -->
</div> <!--end content -->


@endsection
