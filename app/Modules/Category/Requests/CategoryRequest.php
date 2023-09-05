<?php
/**
  * User: Hridoy
 * Date: 26/05/18
 * Time: 9:24 AM
 */

namespace App\Modules\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
        $banner = Request::input('banner_link')?Request::input('banner_link'):'';

        return [
            'title'   => 'required|max:32',
            'slug' => 'required|max:32|unique:category,id,' . $this->get('id'),
            'image_link'   => 'image|mimes:jpeg,png,jpg,gif'. $image,
            'banner_link'   => 'image|mimes:jpeg,png,jpg,gif,svg'. $banner,
            /*'meta_title' => 'max:32',
            'meta_keywords' => 'max:128',
            'meta_image_link' => 'max:128',*/
            'show_in_main_menu' => 'required|max:16',
            'status' => 'required',
        ];

    }

}