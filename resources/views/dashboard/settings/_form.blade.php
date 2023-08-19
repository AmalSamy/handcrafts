<div class="card-body">

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Key</x-form.label>
            <x-form.input name="key" type="text" :value="$settings->key "/>
        </div><!-- end input 1 -->

        <div class="col-sm">
            <x-form.label id="name">Name</x-form.label>
            <x-form.input name="name" type="text" :value=" $settings->name "/>
        </div><!-- end input 1 -->

    </div>
    <br>
    <br>

    <div class="row">

    <div class="col-sm">
        <x-form.label id="name">Value</x-form.label>
        <x-form.textarea name="value"  :value="$settings->value" />
    </div><!-- end input 1 -->

        <div class="col-sm">
            <x-form.label id="name">Status</x-form.label>
            <x-form.input name="status" type="text" value="{{$settings->status}}"/>
        </div><!-- end input 1 -->

</div>


</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
