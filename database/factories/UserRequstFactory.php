<?php

use App\UserRequest;
use Faker\Generator as Faker;

$factory->define(UserRequest::class, function (Faker $faker){

    return [
        'name' => $faker->colorName(),
        'email'=> $faker->email,
        'question' => $faker->sentence,
        'verification' => true
    ];
});
