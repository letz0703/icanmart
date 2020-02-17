<?php

use App\Seller;
use Faker\Generator as Faker;


$factory->define(Seller::class, function (Faker $faker){
    $name = $faker->colorName;
    //dd($name);

    return [
        'name'  => $name,
        'slug'  => $faker->colorName,
        'description' => $faker->sentence,
        'phone' => $faker->phoneNumber,
    ];

});
