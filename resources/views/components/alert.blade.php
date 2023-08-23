
@if (session()->has($type))
<div>
    <div class="card card-{{ $type }}">
    <div class="card-header">
        <h3 class="card-title">{{ $type }}</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    {{session($type)  }}
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endif
