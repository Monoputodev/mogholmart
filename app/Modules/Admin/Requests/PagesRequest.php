<?php
/**
  * User: Mithun
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PagesRequest extends FormRequest
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
                'title' => 'required|max:32',
                'slug' => 'required|max:32|unique:general_pages,id,' . $this->get('id'),
                'image_link'   => 'image|mimes:jpeg,png,jpg,gif|max:1024'.$image,
                
            ];

    }

}