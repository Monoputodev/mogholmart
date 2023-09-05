<?php
/**
  * User: Hridoy
 * Date: 25/05/18
 * Time: 9:27 AM
 */

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PasswordResetRequest extends FormRequest
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
              'old_password'          => 'required',
              'password'              => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required|string|min:6|same:password'
            ];

    }

}