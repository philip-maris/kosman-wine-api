<?php

namespace App\Http\Requests\Testimony;

use Illuminate\Foundation\Http\FormRequest;

class CreateNotificationRequest extends FormRequest
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
            'notificationUserType'=>['required'],
            'notificationUserId'=>['required'],
            'notificationTitle'=>['required', 'max:255'],
            'notificationColor'=>['required'],
            'notificationMessage'=>['required', 'max:255'],
        ];
    }
}
