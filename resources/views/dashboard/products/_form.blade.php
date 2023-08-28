@if($errors->any())
    <div class="alert alert-danger">
        <h3>Error Occured!</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card-body">
    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Name</x-form.label>
            <x-form.input name="name" type="text" value="{{ old('name')?? $product->name }}"/>
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
                <input type="radio" name="is_visible"
                       value="1" @checked(old('is_visible',$product->is_visible) == 1)>
                <label>
                    Yes
                </label>

                <input type="radio" name="is_visible"
                       value="0" @checked(old('is_visible',$product->is_visible) == 0)>
                <label>
                    No
                </label>

            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Slug</x-form.label>
            <x-form.input name="slug" type="text" value="{{old('slug') ?? $product->slug }}"/>
        </div>
        <div class="col-sm">
            <x-form.label id="name">Description</x-form.label>
            <x-form.textarea name="description" :value=" old('description') ?? $product->description"/>
        </div><!-- end input 4 -->
        <div class="col-sm">
            <div class="form-group">
                <label>is_favorite</label> <br>

                <input type="radio" name="is_favorite"
                       value="1" @checked(old('is_favorite',$product->is_favorite) == 1)>
                <label>
                    Yes
                </label>

                <input type="radio" name="is_favorite"
                       value="0" @checked(old('is_favorite',$product->is_favorite) == 0)>
                <label>
                    No
                </label>

            </div>
        </div>
    </div><!-- end row 2 -->

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Quantity</x-form.label>
            <x-form.input name="quantity" type="text" value="{{ old('quantity') ?? $product->quantity }}"/>
        </div>
        <div class="col-sm">
            <x-form.label id="name">Delivery_period</x-form.label>
            <x-form.input name="delivery_period" type="text" value="{{ old('delivery_period') ?? $product->delivery_period }}"/>
        </div>

    </div><!-- end row 2 -->

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <x-form.label id="image"> Image:</x-form.label>
                <x-form.input type="file" name="image" placeholder="image" accept="image/*"/>
                @if (old('image') ?? $product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="img"
                         style="width: 40px;border-radius: 5px;">
                @endif
            </div>

    </div>

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">price</x-form.label>
            <x-form.input name="price" type="text" value="{{ old('price') ?? $product->price }}"/>

        </div>

    <div class="col-sm">
            <x-form.label id="name">compare_price</x-form.label>
            <x-form.input name="compare_price" type="text" value="{{old('compare_price') ?? $product->compare_price }}"/>

    </div>

    <div class="col-sm">
        <x-form.label id="name">opations</x-form.label>
        <x-form.input name="opations" type="text" value="{{old('opations') ?? $product->opations }}"/>
    </div>
</div>

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">rating</x-form.label>
            <x-form.input name="rating" type="text" value="{{ old('rating') ?? $product->rating }}"/>

        </div>

        <div class="col-sm">
            <x-form.label id="name">featured</x-form.label>
            <x-form.input name="featured" type="text" value="{{ old('featured') ?? $product->featured }}"/>
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
