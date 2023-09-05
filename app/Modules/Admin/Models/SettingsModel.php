<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SettingsModel extends Model {

    protected $table='config';
    
    protected $fillable = [
        'key',
        'display_title',
        'value',
        'type'
    ];
}
