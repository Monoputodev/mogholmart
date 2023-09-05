<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BrandRequest extends FormRequest
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
          $image = Request::input('image_link')?Request::input('image_link'):'';

          return [
              'manufacturer_id' => 'required|max:10',
              'title' => 'required|max:32',
              'slug' => 'required|max:32|unique:brand,id' . $this->get('id'),
              'image_link'   => 'image|mimes:jpeg,png,jpg,gif|max:1024'.$image,
              'is_top_brand' => 'required',
              'status' => 'required',
          ];

    }

}