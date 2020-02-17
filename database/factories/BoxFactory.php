<?php

use App\Box;
use Faker\Generator as Faker;

$factory->define(Box::class, function (Faker $faker){

    $title = $faker->colorName();
    $arrived_at = request('arrived_at') ? : \Carbon\Carbon::now()->format('Y-m-d');
    return [
        'seller_id'  => function (){
            return factory('App\Seller')->create()->id;
        },
        'user_id'    => function (){
            return auth()->user() ? : factory('App\User')->create()->id;
        },
        'arrived_at' => $arrived_at,
        'title'      => $title,
        'slug'       => Box::make_slug($arrived_at),
        'locked'     => false,
        'amount'     => $faker->numberBetween(1000, 10000),
        'paid'       => false,
    ];
});
