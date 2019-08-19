<?php

use App\Seller;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker){
    return [
        'name'  => $faker->colorName(),
        'phone' => $faker->phoneNumber,
    ];
    
});
