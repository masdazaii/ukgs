<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\revenue;
use Faker\Generator as Faker;

$factory->define(revenue::class, function (Faker $faker) {
$array = [100000,200000,300000,110000,27000,120000,450000,67800,200000,12000,3400000,750000,270000,1600000,789000];
$result = array_rand($array);

    return [
        'hotel_id' => $faker->randomNumber(2),
        'room' => $faker->randomNumber(1),
        'city' => $faker->randomNumber(3),
        'currency' => $faker->randomNumber(1),
        'booking' => $faker->randomNumber(2),
        'revenue' => $array[$result]
    ];
});
