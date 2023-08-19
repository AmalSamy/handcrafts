<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 21/2/2019
 * Time: 3:14 م
 */

namespace App\Helpers;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Validate
{
    public static function validateRequest($request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 422);
        }
        return 'valid';
    }

}
