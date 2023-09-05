<?php

namespace App\Modules\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MerchantRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shop_name'=> 'required|max:128',
            //'tin_no'=> 'required|max:128',
            'mobile_no'=> 'required|max:15|unique:users',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed',
            'password_confirmation'=> 'required'
        ];
    }


}