<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'category_id'=>['nullable','int','exists:categories,id'],
            'name' => ['required','min:4','string', 'max:255'],
            'is_visible' => ['required'],
            'slug'=>['nullable'],
            'description'=>['nullable'],
            'quantity'=>['nullable'],
            'delivery_period'=>['nullable'],
            'image'=>['nullable'],
            'price'=>['required','numeric'],
            'is_favorite'=>['required'],
            'compare_price'=>['nullable'],
            'opations'=>['nullable'],
            'rating'=>['required','numeric'],
            'featured'=>['required','int'],
            'status'=>['required']
        ];
    }
}
