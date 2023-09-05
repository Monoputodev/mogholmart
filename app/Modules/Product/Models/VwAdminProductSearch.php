<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;

class VwAdminProductSearch  extends Model {

   protected $table = 'vw_admin_product_search';
    protected $fillable = [
        'product_id',
        'product_title',
        'product_merchant_id',
        'attribute_title',
        'product_slug',
        'weight',
        'manufacturer',
        'brand',
        'category_id',
        'category_title',
        'cat_meta_keywords',
        'item_no',
        'sell_price',
        'list_price',
        'offer_price',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'quantity',
        'total_review',
        'average_review',
        'image',
        'status',
    ];

    /*public function relProductCategory()
    {
        return $this->hasMany('App\Modules\Product\Models\ProductCategory', 'product_id', 'product_id');
    }*/



}
