<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Demo',
        'email' => 'Demo@example.org',
		'username' => 'Demo',
        'password' => Hash::make(123456), // password
        'no_hp' => $faker->phoneNumber,
        'alamat' => $faker->cityPrefix.' '.$faker->secondaryAddress.' '.$faker->state,
        'status' => 1,
    ];
});
