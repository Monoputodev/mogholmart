<?php

namespace App\Modules\Discount\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Discount extends Model {

    protected $table = 'product_category_discount';
   
    protected $fillable = [
        'category_id',
        'sub_category_list',
        'disc_percentage',
        'start_date',
        'end_date',
        'type',
        'status',
    ];

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
