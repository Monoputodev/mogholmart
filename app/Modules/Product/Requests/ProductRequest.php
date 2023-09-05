<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
                'attribute_set_id' => 'required',
                'type' => 'required',
                'status' => 'required',
            ];

    }

}