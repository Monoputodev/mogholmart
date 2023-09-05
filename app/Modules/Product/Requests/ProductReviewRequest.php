<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductReviewRequest extends FormRequest
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
                'title' => 'required|max:32',
                'rating_value_score' => 'numeric|max:10',
                'customer_id' => 'required',
                'status' => 'required',
            ];

    }

}