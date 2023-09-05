<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductBaseicRequest extends FormRequest
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
                'slug' => 'required|max:128',
                'item_no' => 'required|max:64|unique:users,id,' . $this->get('id'),
                'sell_price' => 'numeric',
                'list_price' => 'numeric',
                'status' => 'required',
            ];

    }

}