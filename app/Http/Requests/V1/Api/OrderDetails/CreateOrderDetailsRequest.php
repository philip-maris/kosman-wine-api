<?php

namespace App\Http\Requests\V1\Api\OrderDetails;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderDetailsRequest extends FormRequest
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
            'orderDetailsFirstName'=>['required'],
            'orderDetailsLastName'=>['required'],
            'orderDetailsOrderId'=>['required'],
            'orderDetailsEmail'=>['required'],
            'orderDetailsPhone'=>['required'],
            'orderDetailsAddress'=>['required'],
            'orderDetailsState'=>['required']
        ];
    }
}
