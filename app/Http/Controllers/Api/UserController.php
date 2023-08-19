<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Validate;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use GeneralTrait;
    public function profile(){

        $profile=auth('sanctum')->user()->load('profile');

        if($profile){
            return response($this->getResponse(__('my_keywords.operationSuccessfully'),true,$profile),200);
        }else{
            return response($this->getResponse(__('my_keywords.somethingWrong'), false, null), 422);

        }

    }

    public  function updateProfile (){
        $request=Request();
        $rules = [
            'email' => 'required:users,email,',
            'img_profile'=>'nullable',
        ];
        $validator = Validate::validateRequest($request, $rules);
        if ($validator != 'valid') return $validator;
        $userId =auth('sanctum')->user()->id;
        $user = User::find($userId);

        $user->email = $request->email;
        $user->profile->name= $request->name;
        $user->profile->birthday = $request->birthday;
        $user->phone_number =$request->phone_number;
        // if ($request->file('img_profile') and   $request->img_profile != null) {
        //     $user->profile->img_profile= $request->img_profile->store('public/user');
        // }
        if ($request->file('img_profile') and $request->img_profile != null) {

            $path = "uploads/" .
                $request->img_profile->store("assets/images/users", 'public');


            $user->profile->img_profile = $path;
        }




        $user->save();

        return response()->json(["status" => true, "message" => "تم التعديل بنجاح بنجاح", "data" => $user ],200);


    }

    // public function forgotPassword(Request $request){
    //     $rules = [
    //         'password' => 'required|min:6|confirmed',
    //     ];
    //     $validator = Validate::validateRequest($request, $rules);
    //     if ($validator != 'valid') return $validator;
    //     $user = auth('sanctum')->user();
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     return response()->json(['data' => $user, 'message' => 'successfully', 'status' => true], 200);
    // }

    public function updatePassword(Request $request)
    {
        $user = auth('sanctum')->user();
        $rules = [
            'password' => 'required|confirmed|min:6',
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ];
        $validator = Validate::validateRequest($request, $rules);
        if ($validator != 'valid') return $validator;

        $validator = Validate::validateRequest($request, $rules);
        if ($validator != 'valid') return $validator;


        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['data' => $user,
        'message' => 'تم تغيير كلمة المرور', 'status' => true], 200);


    }

    protected function uploadeFile(Request $request){
        // if لازم نخلى ال  انها تكون أقصر
        if(!$request->hasFile('img_profile')){
            return;
        }
        $file=$request->file('img_profile');
        $new_image=$file->store('uploades',['disk'=>'public']);
        return $new_image;
    }

}
