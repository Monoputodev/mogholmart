<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Modules\User\Models\Roles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='users';
    
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'mobile_no',
        'merchant_agreement',
        'image',
        'roles_id',
        'type',
        'remember_token',
        'status',
         'nid',
         'post_code',
        /*'facebook_id',
        'google_id',*/
    ];


    // Relations
    public function relUserRoles(){
        return $this->hasOne('App\Modules\User\Models\Roles', 'id', 'roles_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

   
    //ACL Start

    //check permission
    public function can_access($permission = null){

        return !is_null($permission)  && $this->checkPermission($permission);
    }

    //check if the permission matches with any permission user has
    protected function checkPermission($perm){

        $permissions = $this->getAllPermissionFromAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];
        return array_intersect($permissions, $permissionArray);


    }


    //Get All permission slugs from all permission of all roles
    protected function getAllPermissionFromAllRoles(){

        $permissionsArray = [];

        $role = Roles::findOrFail(\Auth::user()->roles_id);
        $permissions = $role->permissions()->get()->toArray();

        return array_map('strtolower', array_unique(array_flatten(array_map(function($permission){
            return array_pluck(array($permission), 'route');
        }, $permissions))));

    }



    //for facebook login

    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::create($input);
        }


        return $check;
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
