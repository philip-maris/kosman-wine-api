<?php

namespace App\Http\Requests\Testimony;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTestimonyRequest extends FormRequest
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
            'testimonyId'=>['required'],
            'customerId'=>['required'],
        ];
    }
}