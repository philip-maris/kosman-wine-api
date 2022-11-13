<?php

namespace App\Http\Requests\V1\Api\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'couponId'=>['required'],
            'couponCustomerId'=>['required'],
            'couponValue'=>['required', 'max:255'],
            'couponStatus'=>['required', 'max:255'],
        ];
    }
}
