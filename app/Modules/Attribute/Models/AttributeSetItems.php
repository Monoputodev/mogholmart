<?php

namespace App\Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AttributeSetItems extends Model {

    protected $table = 'attribute_set_items';
    protected $fillable = [
        'attribute_id',
        'attribute_set_id',
    ];



    // Relations
    public function relAttribute(){
        return $this->hasOne('App\Modules\Attribute\Models\Attribute', 'id', 'attribute_id');
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
