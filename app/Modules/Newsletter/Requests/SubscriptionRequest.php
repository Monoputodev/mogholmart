<?php
/**
  * User: Hridoy
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\Newsletter\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubscriptionRequest extends FormRequest
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
               
                'email' => 'required|email',
               
            ];

    }

}