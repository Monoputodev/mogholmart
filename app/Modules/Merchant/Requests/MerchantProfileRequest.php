<?php

namespace App\Modules\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MerchantProfileRequest extends FormRequest
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
            'shop_name'   => 'required|string|max:128',
            'shop_address'   => 'required',
            'first_contact_person_details'   => 'required',
            'second_contact_person_details'   => 'required',
        ];
    }


}