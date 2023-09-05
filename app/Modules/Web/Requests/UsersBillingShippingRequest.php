<?php

namespace App\Modules\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersBillingShippingRequest extends FormRequest
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
            'users_id' => 'required|integer',
            'phone'   => 'required|numeric|min:13',
            'first_name' => 'required|string',
            'city' => 'required|string',
            'area' => 'required|string'
        ];
    }


}