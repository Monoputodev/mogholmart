<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShippingCalculationRequest extends FormRequest
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
                'shipping_type' => 'required|max:32',
                'condition' => 'required|max:32',
                'method' => 'required|max:32',
                'main_value' => 'required|max:32',
                'status' => 'required',
            ];

    }

}