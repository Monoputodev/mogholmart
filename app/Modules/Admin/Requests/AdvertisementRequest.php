<?php
namespace App\Modules\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdvertisementRequest extends FormRequest
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
                'slug' => 'required|max:32|unique:advertisement,id,' . $this->get('id'),
                'image_link'   => 'image|mimes:jpeg,png,jpg,gif|max:1024'.$image,
                'type'   => 'required|max:32',
                
            ];

    }

}