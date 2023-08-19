<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     Protected $ruls = [
            'id' => 'required|numeric',
            'user_id'=>'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];

    public function index()
    {

        $result = Store::orderBy('id', 'desc')->get();

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
        $ruls = [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'logo_image' =>'nullable',
            'cover_image' =>'nullable',
        ];

        if ($this->getErrorIfAny($request->all(), $ruls)) {
            return $this->getErrorIfAny($request->all(), $ruls);
        }

        $imageName1 = $request['logo_image']->store('assets/images/stores', 'public');
        $urlLogoImage =  config('paths.storage_path') . $imageName1;

        $imageName2 = $request['cover_image']->store('assets/images/stores', 'public');
        $urlCoverImage =  config('paths.storage_path') . $imageName2;





        $store = new Store();
        $store['name'] = $request['name'];
        $store['user_id'] =$request['user_id'];
        $store['description'] =  $request['description'];
        $store['phone_whatsapp'] =  $request['phone_whatsapp'];
        $store['url_facebook'] =  $request['url_facebook'];
        $store['url_instegram'] =  $request['url_instegram'];
        $store['logo_image'] = $urlLogoImage;
        $store['cover_image'] = $urlCoverImage;
        $store['delivery_price'] =$request['delivery_price'];
        $store['status'] =  $request['status'];

        $result = $store->save();

        if ($result) {
            return response($this->getResponse(__('my_keywords.operationSuccessfully'), true, $store), 200);
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

        $result = Store::find($id);

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
    public function update(Request $request, Store $store)
    {


        if ($this->getErrorIfAny($request->all(), $this->ruls)) {
            return $this->getErrorIfAny($request->all(), $this->ruls);
        }
        $result = null;

        if ($store != null) {
           $result= $store->update($request->all());
        }
        if ($result) {
            return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        }


        // if ($this->getErrorIfAny($request->all(), $this->ruls)) {
        //     return $this->getErrorIfAny($request->all(), $this->ruls);
        // }

        // $result = null;

        // $imageName1 = $request['logo_image']->store(config('paths.store_image_path'), 'public');
        // $urlLogoImage =  config('paths.storage_path') . $imageName1;

        // $imageName2 = $request['cover_image']->store(config('paths.store_image_path'), 'public');
        // $urlCoverImage =  config('paths.storage_path') . $imageName2;


        // if ($store != null) {
        //     if ($store != null) {
        //         $result= $store->update($request->all());
        //      }
        //     // $result = $store->update([
        //     //     'name' => $request->name,
        //     //     'phone_whatsapp' => $request->phone_whatsapp,
        //     //     'url_facebook' => $request->url_facebook,
        //     //     'url_instegram' => $request->url_instegram,
        //     //     'description' => $request->description,
        //     //     'logo_image'=>  $urlLogoImage,
        //     //     'cover_image'=>  $urlCoverImage,
        //     //     'state' => $request->state,
        //     // ]);
        // }

        // if ($result) {
        //     return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        // } else {
        //     return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        // }
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

        $point = Store::find($id);
        $result = null;

        if ($point) {
            $result = $point->delete();
        }

        if ($result) {
            return response($this->getResponseFail(__('my_keywords.operationSuccessfully'), true, $result), 200);
        } else {
            return response($this->getResponseFail(__('my_keywords.somethingWrong'), false, null), 422);
        }
    }
}
