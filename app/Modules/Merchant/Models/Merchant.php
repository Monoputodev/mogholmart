<?php

namespace App\Modules\Merchant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Merchant extends Model {

    protected $table='merchant_profiles';
    
    protected $fillable = [
        'users_id',
        'shop_name',
        'fathers_name',
        'age',
        'nid',
        'tin_no',
        'shop_address',
        'shop_description',
        'shop_agreement',
        'agreement_date',
        'agreement_details',
        'first_contact_person_details',
        'second_contact_person_details',
    ];

}
