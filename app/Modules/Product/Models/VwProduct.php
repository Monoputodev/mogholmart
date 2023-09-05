<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class VwProduct extends Model {

   protected $table = 'vw_product';
    protected $fillable = [
        'product_id',
        'product_title',
        'product_slug',
        'short_description',
        'specification',
        'description',
        'manufacturer',
        'brand',
        'item_no',
        'sell_price',
        'list_price',
        'image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'quantity'
    ];

    public function relProductCategory()
    {
        return $this->hasMany('App\Modules\Product\Models\ProductCategory', 'product_id', 'product_id');
    }

}
