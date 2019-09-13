<?php

use App\Seller;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker){
    $name = $faker->colorName();
    return [
        'name'  => $name,
        'slug'  => str_slug($name),
        'phone' => $faker->phoneNumber,
    ];
    
});
