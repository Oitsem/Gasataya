<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Person;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'birthdate' => Carbon::now(),
        'email' => $faker->unique()->safeEmail
    ];
});
