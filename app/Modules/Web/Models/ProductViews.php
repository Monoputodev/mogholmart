<?php

namespace App\Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductViews extends Model {

     protected $table = 'product_views';

     public static function createViewLog($product) {

        $postViews= new ProductViews();
        $postViews->product_id = $product->product_id;
        $postViews->titleslug = $product->product_slug;
        $postViews->url = \Request::url();
        $postViews->session_id = \Request::getSession()->getId();
        $postViews->user_id = (\Auth::check())?\Auth::id():null;
        $postViews->ip = \Request::getClientIp();
        $postViews->agent = \Request::header('User-Agent');
        $postViews->save();
    }
    

}
