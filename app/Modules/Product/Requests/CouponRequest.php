<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CouponRequest extends FormRequest
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
                'coupon_name' => 'required|max:32',
                'coupon_code' => 'required|max:32|unique:coupon,id' . $this->get('id'),
                'coupon_type' => 'required|max:32',
                'valid_from' => 'required',
                'valid_to' => 'required',
                'amount' => 'required',
                'status' => 'required',
            ];

    }

}