<?php

use App\Box;
use Faker\Generator as Faker;

$factory->define(Box::class, function (Faker $faker){
    $title = $faker->sentence();
    $arrived_at = $faker->date();
    return [
        'seller_id' => function (){
            return factory('App\Seller')->create()->id;
        },
        'user_id' => function (){
            return auth()->user()? : factory('App\User')->create()->id;
        },
        'arrived_at'=> $arrived_at,
        'title' => $title,
        'slug' => str_slug($arrived_at),
        'amount' => $faker->numberBetween(1000,10000),
        'paid' => false,
    ];
});
