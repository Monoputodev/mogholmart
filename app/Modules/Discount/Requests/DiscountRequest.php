<?php

namespace App\Modules\Discount\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DiscountRequest extends FormRequest
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
            'category_id' => 'required|max:256',
            'discount_parcentage' => 'required|max:128',
            'start_date' => 'required|max:32',
            'end_date' => 'required|max:32',
            'type' => 'required|max:32',
            'status' => 'required|max:32'
        ];
    }


}