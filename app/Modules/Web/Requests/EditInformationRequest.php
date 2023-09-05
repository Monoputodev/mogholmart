<?php

namespace App\Modules\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditInformationRequest extends FormRequest
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
            'first_name'   => 'required|string',
            'mobile_no'   => 'required|numeric|min:11|max:13',
            'email'   => 'email|unique:users,id,'. $this->id
        ];
    }


}