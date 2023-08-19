<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user();
        $orders = Order::with(['User','Store'])->paginate();
        return response()->view('dashboard.orders.index',compact("orders","user_id"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders = new Order();
        return response()->view('dashboard.orders.create',compact("orders"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Order::rouls());

        $user = Auth::user();
        $storeId = $user->store_id;

            $user_id = Auth::check() ? auth()->user()->id : '';
            if ($user_id != '') {
                Order::create([
                    'delivery_date' => $request->delivery_date,
                    'delivery_time' => $request->delivery_time,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_status,
                    'user_id' => $user_id,
                    'store_id' => $storeId

                ]);
                return redirect()->route('dashboard.orders.index')->with('success', 'New Order Created');
            } else {
                redirect()->route('login');
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->view('dashboard.orders.show',compact('order'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $orders=Order::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.orders.index')->with('info','item not found ');
        }

        return response()->view('dashboard.orders.edit',compact('orders'));
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
        $request->validate(Order::rouls());
        $orders=Order::findOrFail($id);


        $orders->delivery_date = $request->post('delivery_date');
        $orders->delivery_time = $request->post('delivery_time');
        $orders->payment_method = $request->post('payment_method');
        $orders->payment_status = $request->post('payment_status');

        $orders->update();


        return redirect('dashboard/orders')->with('success', 'Order Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Order::findOrFail($id);
        $category->delete();


        return redirect('dashboard/orders')->with('success', 'Order Deleted!');
    }

    public function trash(){
        $orders=Order::onlyTrashed()->paginate();
        return view('dashboard.orders.trash',compact('orders'));

    }

    public function restore(Request $request, $id){
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->restore();
        return redirect()->route('dashboard.orders.trash')
            ->with('success','Order restore!');



    }

    public function forceDelete($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->forceDelete();


        return redirect()->route('dashboard.orders.trash')
            ->with('success', 'order deleted forver!');
    }

    }
