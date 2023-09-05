<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Modules\Product\Models\VwProduct;
use App\Modules\Product\Models\Product;

class OrderHead extends Model {

   protected $table = 'order_head';
    protected $fillable = [
        'users_id',
        'order_number',
        'date',
        'vat_rate',
        'vat_amount ',
        'coupon_code ',
        'coupon_code_rate ',
        'coupon_code_value ',
        'shipping_value ',
        'shipping_method ',
        'sub_total_price ',
        'total_price ',
        'payment_type ',
        'status',
        'courier_name',
        'courier_package',
        'courier_id',
        'courier_message'
    ];


    public function relOrderShipping(){
        return $this->hasMany('App\Modules\Order\Models\OrderShipping');
    }

    public function relOrderDetail(){
        return $this->hasMany('App\Modules\Order\Models\OrderDetails');
    }

    // Relations
    public function relTransection(){
        return $this->hasOne('App\Modules\Order\Models\OrderTransaction', 'order_head_id', 'id');
    }

    public static function getOrderItems($order_head){
        return VwProduct::join('order_details', 'order_details.product_id', '=', 'vw_product.product_id')
                        ->join('merchant_profiles','merchant_profiles.users_id','=','order_details.product_merchant_id')
                        ->where('order_details.order_head_id',$order_head->id)
                        ->select('vw_product.*','order_details.quantity','order_details.color','order_details.size','merchant_profiles.shop_name','merchant_profiles.first_contact_person_details')
                        ->get();
    }

   

    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = @\Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = @\Auth::user()->id;
            }
        });
    }
    

}
