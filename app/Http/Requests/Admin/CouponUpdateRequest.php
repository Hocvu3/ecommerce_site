<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'name'=>['required','max:400'],
            'code'=>['required','max:300'],
            'quantity'=>['required','integer','max:500'],
            'min_purchase_amount'=>['required','integer'],
            'expire_date'=>['required','date'],
            'discount_type'=>['required'],
            'discount'=>['required','integer'],
            'status'=>['required'],
        ];
    }
}
