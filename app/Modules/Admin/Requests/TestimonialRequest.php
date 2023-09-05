<?php
namespace App\Modules\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TestimonialRequest extends FormRequest
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
                'slug' => 'required|max:32|unique:testimonial,id,' . $this->get('id'),
                'description' =>'required'
            ];

    }

}