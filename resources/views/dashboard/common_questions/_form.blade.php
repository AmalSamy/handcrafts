<div class="card-body">

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">Title</x-form.label>
            <x-form.input name="title" type="text" :value="old('title')?? $common_questions->title "/>
        </div><!-- end input 1 -->

        <div class="col-sm">
            <x-form.label id="name">Description</x-form.label>
            <x-form.input name="desc" type="text" :value=" old('desc')?? $common_questions->desc "/>
        </div><!-- end input 1 -->

    </div>
    <br>
    <br>

    <div class="row">


        <div class="col-sm">
            <div class="form-group">
                <label>Status</label> <br>
                <input type="radio" name="status"
                       value="1" @checked(old('status',$common_questions->status) == 1)>
                <label>
                    Yes
                </label>

                <input type="radio" name="status"
                       value="0" @checked(old('status',$common_questions->status) == 0)>
                <label>
                    No
                </label>
            </div>
        </div>
</div>


</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
