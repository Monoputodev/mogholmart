<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ManufactureRequest extends FormRequest
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
                'title' => 'required|max:64',
                'slug' => 'required|max:64|unique:manufacturer,id' . $this->get('id'),
                'image_link'   => 'image|mimes:jpeg,png,jpg,gif|max:1024'.$image,
                'status' => 'required',
            ];

    }

}