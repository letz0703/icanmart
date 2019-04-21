<?php

use App\Box;
use Faker\Generator as Faker;

$factory->define(Box::class, function (Faker $faker){
    return [
        'seller_id' => function (){
            return factory('App\Seller')->create()->id;
        },
        'arrived_at'=> $faker->date(),
        'title' => $faker->sentence(),
        'amount' => $faker->numberBetween(1000,10000),
        'paid' => false
    ];
});
