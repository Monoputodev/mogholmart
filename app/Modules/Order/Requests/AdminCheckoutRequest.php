<?php

namespace App\Modules\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminCheckoutRequest extends FormRequest
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
        $rules = [
            'address'   => 'required|string',
            'phone'   => 'required|numeric|min:11',
            'payment_method' => 'required|string',
            'first_name' => 'required|string',
            /*'email' => 'required|email'*/
            /*'city' => 'required|string',
            'area' => 'required|string'*/
        ];

       

        return $rules;
    }


}