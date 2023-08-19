@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Settings Trashed</li>
@endsection

@section('content')
    <div class="row mx-4 mb ">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success " href="{{ route('dashboard.settings.index') }}"> <i
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
                    <th>Key</th>
                    <th>name</th>
                    <th>Value</th>
                    <th>status</th>
                    <th>Active</th>


                </tr>
                </thead>
                <tbody>
                @if ($settings->count())
                    @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $setting->id }}</td>
                            <td>{{ $setting->key }}</td>
                            <td>{{ $setting->name }}</td>
                            <td>{{ $setting->value }}</td>
                            <td>{{ $setting->status }}</td>

                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('dashboard.settings.restore', $setting->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-info mx-2"><strong>Restore</strong></button>
                                    </form>

                                    <form action="{{ route('dashboard.settings.force-delete', $setting->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><strong>Delete</strong> </button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">No Settings</td>
                    </tr>
                @endif

                </tbody>
            </table>


            {{ $settings->withQueryString()->links() }}
    </div>
    </div>
    <!-- /.card-body -->

@endsection

@section('footer')
@endsection

@push('script')
@endpush
