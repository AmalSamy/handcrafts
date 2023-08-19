<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use GeneralTrait;

    protected $ruls = [
        'user_id' => 'required|numeric',
        'store_id' => 'required|numeric',
        'delivery_time' => 'time|nullable',
        'delivery_date' => 'date|nullable',
        'payment_method' => 'required',
        'total' => 'required|numeric',
    ];

    public function index()
    {
        $result = Order::with(['orderItems', 'user'])->orderBy('id', 'desc')->simplePaginate();

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

        $order = new Order();
        $order['user_id'] =  $request['user_id'];
        $order['store_id'] =  $request['store_id'];
        $order['delivery_time'] =  $request['delivery_time'];
        $order['delivery_date'] =  $request['delivery_date'];
        $order['payment_method'] =  $request['payment_method'];
        $order['payment_status'] =  $request['payment_status'];
        $order['total'] =  $request['total'];

        $result = $order->save();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $order), 200);
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

        $result = Order::with(['orderItems', 'user',])->find($id);

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

        $order = Order::find($id);

        $result = null;

        if ($order != null) {
            $result = $order->update([
                'store_id'=> $request['store_id'],
                'delivery_time'=> $request['delivery_time'],
               'delivery_date'=> $request['delivery_date'],
               'payment_method'=> $request['payment_method'],
               'payment_status'=> $request['payment_status'],
               'total'=> $request['total'],

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

        $product = Order::find($id);
        $result = null;

        if ($product) {
            $result = $product->delete();
        }

        if ($result) {
            return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }
}
