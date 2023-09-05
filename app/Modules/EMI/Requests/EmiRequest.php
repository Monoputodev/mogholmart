<?php

namespace App\Modules\EMI\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmiRequest extends FormRequest
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
            'bank_name' => 'required|max:128|unique:hubs,id,' . $this->get('id'),
            'emi_month' => 'required|max:32',
            'emi_rate' => 'required|max:32',
        ];
    }


}