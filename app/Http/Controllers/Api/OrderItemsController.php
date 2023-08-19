<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    use GeneralTrait;

    protected $ruls = [
        'order_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'product_name' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
    ];

    public function index()
    {
        $result = OrderItems::with(['order', 'product'])->orderBy('id', 'desc')->simplePaginate();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->getErrorIfAny($request->all(), $this->ruls)) {
            return $this->getErrorIfAny($request->all(), $this->ruls);
        }

        $order_item = new OrderItems();
        $order_item['order_id'] =  $request['order_id'];
        $order_item['product_id'] =  $request['product_id'];
        $order_item['quantity'] =  $request['quantity'];
        $order_item['price'] =  $request['price'];
        $order_item['product_name'] =  $request['product_name'];

        $result = $order_item->save();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $order_item), 200);
        } else {
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruls = ['id' => 'required|numeric'];

        if ($this->getErrorIfAny(['id' => $id], $ruls)) {
            return $this->getErrorIfAny(['id' => $id], $ruls);
        }

        $result = OrderItems::with(['order', 'product'])->find($id);

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->getErrorIfAny($request->all(), $this->ruls)) {
            return $this->getErrorIfAny($request->all(), $this->ruls);
        }

        $order_item = OrderItems::find($id);

        $result = null;

        if ($order_item != null) {
            $result = $order_item->update([
                'order_id' =>  $request['order_id'],
                'product_id' =>  $request['product_id'],
                'quantity' =>  $request['quantity'],
                'price' =>  $request['price'],
                'product_name' =>  $request['product_name'],
            ]);
        }

        if ($result) {
            return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruls = ['id' => 'required|numeric'];

        if ($this->getErrorIfAny(['id' => $id], $ruls)) {
            return $this->getErrorIfAny(['id' => $id], $ruls);
        }

        $order_item = OrderItems::find($id);
        $result = null;

        if ($order_item) {
            $result = $order_item->delete();
        }

        if ($result) {
            return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }
}
