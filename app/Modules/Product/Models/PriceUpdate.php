<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PriceUpdate extends Model {

    protected $table = 'price_update';
   
    protected $fillable = [
        'product_id',
        'actual_price',
        'update_price',
        'list_price',
        'list_update_price',
    ];

    

}
