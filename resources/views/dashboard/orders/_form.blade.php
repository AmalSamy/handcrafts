<div class="card-body">

    <div class="row">
        <div class="col-sm">
            <x-form.label id="name">delivery_date</x-form.label>
            <x-form.input name="delivery_date" type="text" value="{{ $orders->delivery_date }}"/>
        </div><!-- end input 1 -->

        <div class="col-sm">
            <x-form.label id="name">delivery_time</x-form.label>
            <x-form.input name="delivery_time" type="text" value="{{ $orders->delivery_time }}"/>
        </div><!-- end input 1 -->

    </div>
    <br>
    <br>

    <div class="row">

    <div class="col-sm">
        <x-form.label id="name">payment Method</x-form.label>
        <x-form.input name="payment_method" type="text" :value="$orders->payment_method" />
    </div><!-- end input 1 -->


    <div class="col-sm-6">
        <div class="form-group">
            <label> Payment Status</label>
            <select class="form-control" name="payment_status">
                <option value="pending">pending</option>
                <option value="paid">paid</option>
                <option value="failed">failed</option>


            </select>
        </div>

    </div><!-- end input 2 -->

</div>


</div> <!--end body -->


<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $buttom_lapel ?? 'save' }}</button>
</div> <!--end footer-->
