<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

    return [
        'email' => 'admin@gmail.com',
        'password' => Hash::make("Hmlqpt345@#$"), // secret
        'first_name' => 'Xotil',
        'last_name' => 'Admin',
        'mobile_no' => $faker->phoneNumber,
        'nid' => $faker->bankAccountNumber,
        'image' => null,
        'roles_id' => 1,
        'type' => 'admin',
        'status' => 'active',
        'remember_token' => str_random(10),
        'created_by' => 1,
        'updated_by' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
