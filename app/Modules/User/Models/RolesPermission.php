<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RolesPermission extends Model {

    protected $table='roles_permission';
    
    protected $fillable = [
        'roles_id',
        'permission_id',
        'status'
    ];


    // Relations
    public function relRoles(){
        return $this->hasOne('App\Modules\User\Models\Roles', 'id', 'roles_id');
    }

    // Relations
    public function relPermission(){
        return $this->hasOne('App\Modules\User\Models\Permission', 'id', 'permission_id');
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
