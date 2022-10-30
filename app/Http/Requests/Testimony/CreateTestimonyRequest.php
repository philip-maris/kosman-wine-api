<?php

namespace App\Http\Requests\Testimony;

use Illuminate\Foundation\Http\FormRequest;

class CreateTestimonyRequest extends FormRequest
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
            'testimonyCustomerId'=>['required', 'max:255'],
            'testimonyContent'=>['required', 'max:255'],
            'testimonyStatus'=>['required', 'max:255'],
        ];
    }
}
