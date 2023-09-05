<?php

namespace App\Modules\Merchant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MerchantImageRequest extends FormRequest
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
           $image = Request::input('file')?Request::input('file'):'';
            return [
                'image_link'   => 'image'.$image,
            ];

    }

}


