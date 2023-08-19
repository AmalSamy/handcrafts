<div class="card-body">

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Title</x-form.label>
            <x-form.input name="title" type="text" :value="$common_questions->title "/>
        </div><!-- end input 1 -->

        <div class="col-sm">
            <x-form.label id="name">Description</x-form.label>
            <x-form.input name="desc" type="text" :value=" $common_questions->desc "/>
        </div><!-- end input 1 -->

    </div>
    <br>
    <br>

    <div class="row">

    <div class="col-sm">
        <x-form.label id="name">Status</x-form.label>
        <x-form.input name="status"  :value="$common_questions->status" />
    </div><!-- end input 1 -->


</div>


</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
