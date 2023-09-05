<?php
/**
  * User: Mithun
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SliderRequest extends FormRequest
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
                'slug' => 'required|max:32|unique:slider,id,' . $this->get('id'),
                
                'caption' => 'required|max:255',
                'type'   => 'required|max:32',
                'short_order' => 'required|max:11'
            ];

    }

}