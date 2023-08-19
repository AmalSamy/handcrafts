<?php

namespace App\Http\Controllers\Api;

use App\Models\Communication;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommunicationController extends Controller
{
    use GeneralTrait;

    public function ContactUs(Request $request)
    {
        $request->validate([
            'email'=> 'required' ,
            'name' =>'required',
            'message'=> 'required' ,
        ]);

        $request->merge(['user_id' =>auth('sanctum')->user()->id]);
        Communication::create($request->all());

        return $this->SuccessApi(null);
    }
}
