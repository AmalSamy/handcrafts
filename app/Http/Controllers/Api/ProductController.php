<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Validate;
use App\Http\Controllers\Controller;
use App\Models\Product;
// use App\Models\User\favorites;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use GeneralTrait;

    public function __construct(){
        $this->middleware('auth:sanctum')->except('index','show','update');
    }

    protected $ruls = [
        'category_id' => 'required|numeric',
        'store_id' => 'required|numeric',
        'name' => 'required|string',
        'description' => 'required|string',
        'quantity' =>'numeric',
        'price' => 'required|numeric',
    ];


       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=Product::with(['productImages','store','category'])->simplePaginate();
        if($result){
            return response($this->getResponse(__('my_keywords.operationSuccessfully'),true,$result),200);
        }else{
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
          // $product=Product::create([ $request->all()]);

        $product = new Product();
        $product['category_id'] =  $request['category_id'];
        $product['store_id'] =  $request['store_id'];
        $product['name'] =  $request['name'];
        $product['description'] =  $request['description'];
        $product['price'] =  $request['price'];
        $product['rating'] =  $request['rating'];
        $product['delivery_period'] =  $request['delivery_period'];
        $product['quantity'] =  $request['quantity'];
        $product['is_visible'] =$request['is_visible'];

        $result = $product->save();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $product), 200);
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

        $result = Product::with(['productImages'])->find($id);

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $result), 200);
        }else {
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
    public function update(Request $request, Product $product)
    {
        if ($this->getErrorIfAny($request->all(), $this->ruls)) {
            return $this->getErrorIfAny($request->all(), $this->ruls);
        }
        $result = null;

        if ($product != null) {
           $result= $product->update($request->all());
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

        $product = Product::find($id);
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
public function favorites(Request $request)
{
    $favorite = auth('sanctum')->user()->favorites()->with('product')->get();
    if ($favorite)
        return response()->json(['data' => $favorite, 'status' => true, 'message' => 'تم العرض'], 200);
    else
        return response()->json(['data' => $favorite, 'status' => false, 'message' => 'لا يوجد اصناف'], 422);

}

public function addproductToFavorites(Request $request)
{
    if (!auth('sanctum')->user())
        return response()->json(['message' => 'لا يستطيع الزائر ازالة عرض من المفضلة'], 422);
    $rules = [
        'product_id' => 'required'
    ];
    $messages = [
        'product_id.required' => 'حقل رقم المنتج مطلوب'
    ];
    $validator = Validate::validateRequest($request, $rules, $messages);
    if ($validator !== 'valid') return $validator;

    $product = Product::find($request->product_id);
    if (!$product)
        return response()->json(['message' => 'المنتج غير موجود','status'=>false], 422);

    $favorite = auth('sanctum')->user()->favorites->where('product_id', $request->product_id)->first();
    if ($favorite)
        return response()->json(['message' => 'لا يمكن اضافة المنتج مرة اخرى للمفضلة' ,'status'=>false], 422);
    $userId = auth('sanctum')->user();
    $favorite = auth('sanctum')->user()->favorites()->create(['product_id' => $request->product_id,'customer_id'=>$userId->id]);

    return response()->json(['data' => $favorite,'message' => 'تم بنجاح','status'=>true], 200);
}
public function removeProductFromFavorites(Request $request)
{
    if (!auth('sanctum')->user())
        return response()->json(['message' => 'لا يستطيع الزائر ازالة المنتج من المفضلة'], 422);
    $rules = [
        'product_id' => 'required'
    ];
    $messages = [
        'product_id.required' => 'حقل رقم المنتج مطلوب'
    ];
    $validator = Validate::validateRequest($request, $rules, $messages);
    if ($validator !== 'valid') return $validator;

    $product = Product::find($request->product_id);
    if (!$product)
        return response()->json(['message' => 'المنتج غير موجود' ,'status'=>false], 422);

    $favorite = auth('sanctum')->user()->favorites()->where('product_id', $request->product_id)->first();
    if (!$favorite)
        return response()->json(['message' => 'المنتج غير مضافة إلى المفضلة' ,'status'=>false], 422);

    $favorite->delete();
    return response()->json(['message' =>  'تمت إزالة المنتج من المفضلة','status'=>true], 200);
}













}

