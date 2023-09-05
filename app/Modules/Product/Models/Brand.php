<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Brand extends Model {



    protected $table = 'brand';
    
    protected $fillable = [
        'manufacturer_id',
        'title',
        'slug',
        'is_top_brand',
        'image_link',
        'meta_title',
        'meta_description',
        'meta_image_link',
        'status'
    ];

    
    // Relations
    public function relManufacturer(){
        return $this->hasOne('App\Modules\Product\Models\Manufacturer', 'id', 'manufacturer_id');
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
