<?php

namespace App\Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Wishlist extends Model {

    protected $table = 'wishlist';
    protected $fillable = [
        'users_id',
        'product_id'
    ];


    public function relProduct(){
        return $this->belongsTo('App\Modules\Product\Models\VwProduct', 'product_id', 'product_id');
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
