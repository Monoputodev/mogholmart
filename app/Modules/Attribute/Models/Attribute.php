<?php

namespace App\Modules\Attribute\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Attribute extends Model {

    protected $table = 'attribute';

    protected $fillable = [
        'code_column',
        'type',
        'type_is_required',
        'order',
        'backend_title',
        'frontend_title',
        'default_value',
        'use_in_quick_search',
        'use_in_advance_search',
        'use_in_filter',
        'status'
    ];

    // Relations

    public function relAttributeOption()
    {
        return $this->hasMany('App\Modules\Attribute\Models\AttributeOption', 'attribute_id',  'id')->orderBy('backend_title','asc');
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
