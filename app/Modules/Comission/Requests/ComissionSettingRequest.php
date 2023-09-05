<?php

namespace App\Modules\Comission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ComissionSettingRequest extends FormRequest
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
            'merchant_id'   => 'required|unique:comissions_setting,id,'. $this->get('id'),
            'comission_rate'   => 'required|numeric|max:10',
            'comission_type'   => 'required'
        ];
    }


}