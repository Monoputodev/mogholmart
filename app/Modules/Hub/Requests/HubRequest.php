<?php

namespace App\Modules\Hub\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class HubRequest extends FormRequest
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
            'title' => 'required|max:128',
            'slug' => 'required|max:128|unique:hubs,id,' . $this->get('id'),
        ];
    }


}