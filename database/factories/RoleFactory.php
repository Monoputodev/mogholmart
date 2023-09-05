<?php

use App\Modules\User\Models\Roles;
use Faker\Generator as Faker;


$factory->define(Roles::class, function (Faker $faker) {

    return [
        'title' => 'Super Admin',
        'slug' => 'super-admin',
        'status' => 'active',
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
