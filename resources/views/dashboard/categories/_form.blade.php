<div class="card-body">
    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Name</x-form.label>
            <x-form.input name="name" type="text" value="{{ $category->name }}"/>
        </div><!-- end input 1 -->
        <div class="col-sm-6">
            <div class="form-group">
                <label> Select Parent</label>
                <select class="form-control" name="parent_id">

                    <option value="">Primary Category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)> {{ $parent->name }} </option>
                    @endforeach
                </select>
            </div>

        </div><!-- end input 2 -->
    </div> <!-- end row 1 -->

    <div class="row">
        <div class="col-sm">
            <div class="form-group">
                <label>Status</label> <br>
                    <input type="checkbox" name="status"  value="active" @checked(old('status',$category->status) == 'active')>
                    <label>
                        active
                    </label>

                    <input type="checkbox" name="status" value="archived" @checked(old('status',$category->status) == 'archived')>
                    <label>
                        archived
                    </label>
            </div>
        </div><!-- end input 3 -->
        <div class="col-sm">
            <div class="form-group">
                <label>Description</label>
                <x-form.textarea  name="description"
                 placeholder="Enter ..." :value="$category->description" />
            </div>
        </div><!-- end input 4 -->
    </div><!-- end row 2 -->

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <x-form.label id="image"> Image: </x-form.label>
            <x-form.input type="file" name="image" placeholder="image" accept="image/*" />
            @if ($category->image)
            <img src="{{ asset('storage/'.$category->image) }}" alt="img" style="width: 40px;border-radius: 5px;">
            @endif
        </div>
    </div><!-- end input 5-->



</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
