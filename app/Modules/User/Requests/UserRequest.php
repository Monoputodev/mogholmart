<?php
/**
  * User: Hridoy
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
                'email' => 'required|email|unique:users,id,' . $this->get('id'),
                'first_name' => 'required|max:32',
                'last_name' => 'required|max:32',
                'roles_id' => 'required|max:11',
            ];

    }

}