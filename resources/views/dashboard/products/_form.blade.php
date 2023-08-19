<div class="card-body">
    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Name</x-form.label>
            <x-form.input name="name" type="text" value="{{ $product->name }}"/>
        </div><!-- end input 1 -->
        <div class="form-group">
            <label for="">Category</label>
            <select name="category_id" class="form-control form-select">
                <option value="">Primary Category</option>
                @foreach(App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm">
            <div class="form-group">
                <label>is_visible</label> <br>
                <input type="checkbox" name="is_visible"
                       value="1" @checked(old('is_visible',$product->is_visible) == 'Yes')>
                <label>
                    Yes
                </label>

                <input type="checkbox" name="is_visible"
                       value="0" @checked(old('is_visible',$product->is_visible) == 'No')>
                <label>
                    No
                </label>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Slug</x-form.label>
            <x-form.input name="slug" type="text" value="{{ $product->slug }}"/>
        </div>
        <div class="col-sm">
            <x-form.label id="name">Description</x-form.label>
            <x-form.textarea name="description" :value="$product->description"/>
        </div><!-- end input 4 -->
    </div><!-- end row 2 -->

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Quantity</x-form.label>
            <x-form.input name="quantity" type="text" value="{{ $product->quantity }}"/>
        </div>
        <div class="col-sm">
            <x-form.label id="name">Delivery_period</x-form.label>
            <x-form.input name="delivery_period" type="text" value="{{ $product->delivery_period }}"/>
        </div>

    </div><!-- end row 2 -->

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <x-form.label id="image"> Image:</x-form.label>
                <x-form.input type="file" name="image" placeholder="image" accept="image/*"/>
                @if ($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="img"
                         style="width: 40px;border-radius: 5px;">
                @endif
            </div>

    </div>

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">price</x-form.label>
            <x-form.input name="price" type="text" value="{{ $product->price }}"/>

        </div>

    <div class="col-sm">
            <x-form.label id="name">compare_price</x-form.label>
            <x-form.input name="compare_price" type="text" value="{{ $product->compare_price }}"/>

    </div>

    <div class="col-sm">
        <x-form.label id="name">opations</x-form.label>
        <x-form.input name="opations" type="text" value="{{ $product->opations }}"/>
    </div>
</div>

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">rating</x-form.label>
            <x-form.input name="rating" type="text" value="{{ $product->rating }}"/>

        </div>

        <div class="col-sm">
            <x-form.label id="name">featured</x-form.label>
            <x-form.input name="featured" type="text" value="{{ $product->featured }}"/>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>  Status</label>
            <select class="form-control" name="status">
                <option value="active">active</option>
                <option value="draft">draft</option>
                <option value="archvied">archvied</option>


            </select>
        </div>

    </div>


</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
