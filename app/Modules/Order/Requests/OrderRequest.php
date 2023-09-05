<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderRequest extends FormRequest
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
                'user_id' => 'required|max:11',
                'user_number' => 'required|max:32',
                'date' => 'required|date',
                'shipping_value' => 'required',
                'shipping_method' => 'required',
                'sub_total_price' => 'required',
                'total_price' => 'required',
                'payment_type' => 'required|max:16',
                'status' => 'required|unique:order_head',
            ];

    }

}