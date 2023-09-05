<?php
/**
  * User: Hridoy
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\Newsletter\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PromotionRequest extends FormRequest
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
                'template_id' => 'required|max:10',
                'title' => 'required|max:32',
                'date' => 'required|date',
                'sent_status' => 'required|max:16',
                'total_customer' => 'required|max:16',
                'total_sent' => 'required|max:16'
            ];

    }

}