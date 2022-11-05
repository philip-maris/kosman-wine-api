<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'bannerHeroImage'=>['required', 'max:255'],
            'bannerStatus'=>['required', 'max:255'],
            'bannerTittle'=>['required', 'max:255'],
            'bannerCustomerId'=>['required'],
        ];
    }
}
