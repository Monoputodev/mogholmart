<?php

namespace App\Modules\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminMerchantRegisterRequest extends FormRequest
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
            'merchant_agreement' => 'required',
            'shop_name'   => 'required|max:128',
            'mobile_no'   => 'required|max:15|unique:users,id,' . $this->get('id'),
            'email'=> 'required|email|unique:users,id,' . $this->get('id'),
            'first_name' => 'required|max:32',
            'last_name' => 'required|max:32',
            'type' => 'required',
            
            
        ];
    }


}