<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [

            'store_id'=>['required','int','exists:stores,id'],
            'category_id'=>['nullable','int','exists:categories,id'],
            'name' => ['required','min:4','string', 'max:255'],
            'is_visible' => ['required'],
            'slug'=>['nullable'],
            'description'=>['nullable'],
            'quantity'=>['nullable'],
            'delivery_period'=>['nullable'],
            'image'=>['nullable'],
            'price'=>['required','double'],
            'is_favorite'=>['required'],
            'compare_price'=>['nullable'],
            'opations'=>['nullable'],
            'rating'=>['required','double'],
            'featured'=>['required','int'],
            'status'=>['required']

        ];
    }
}
