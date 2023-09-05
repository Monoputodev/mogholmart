<?php

namespace App\Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Division extends Model {

    protected $table='division_district_thana_rel';
    
    protected $fillable = [
        'name',
        'sort_order',
        'type',
        'status',
        'parent_id'
    ];

}
