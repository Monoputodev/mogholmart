<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderShipping extends Model {

   protected $table = 'order_shipping';
    protected $fillable = [
        'order_head_id',
        'type',
        'first_name',
        'last_name',
        'compnay_name ',
        'email',
        'address',
        'special_instruction',
        'contry',
        'city',
        'area',
        'post_code',
        'zip',
        'phone',
        'fax ',
        'status'
    ];


    // Relations
    public function relCityName(){
        return $this->hasOne('App\Modules\Web\Models\Division', 'id', 'city');
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
