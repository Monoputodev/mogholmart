<?php
/**
  * User: Hridoy
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\Template\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TemplateRequest extends FormRequest
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
                'slug' => 'required|max:32',
                'template_code' => 'required',
                'is_defult' => 'required|max:11',
                'type'   => 'required|max:32',
                'short_order' => 'required|max:11'
            ];

    }

}