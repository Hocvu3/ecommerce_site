<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image'=>['image','required','max:5000'],
            'name'=>['required','max:500'],
            'category_id'=>['required'],
            'price'=>['required','numeric'],
            'offer_price'=>['nullable','numeric'],
            'quantity'=>['nullable','numeric'],
            'short_description'=>['max:20000'],
            'long_description'=>['max:20000'],
            'sku'=>['nullable'],
            'seo_title'=>['nullable','max:500'],
            'seo_description'=>['nullable','max:500'],
            'show_at_home'=>['required','boolean'],
            'status'=>['boolean','required'],
        ];
    }
}
