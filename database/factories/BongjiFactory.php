<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Bongji;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Bongji::class, function (Faker $faker){
    return [
        'user_id' => function (){
            return factory('App\User')->create()->id;
        },
        'amount' => 0,
        'paid' => true
    ];
});
