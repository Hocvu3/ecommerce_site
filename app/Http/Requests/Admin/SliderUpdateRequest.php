<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'image'=>['nullable','image','max:10000'],
            'offer'=>['nullable','max:200'],
            'title'=>['required','max:200'],
            'sub_title'=>['nullable','max:200'],
            'short_description'=>['nullable','max:2000'],
            'button_link'=>['nullable','max:200'],
            'status'=>['required'],
        ];
    }
}
