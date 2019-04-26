<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\Item;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Item::class, function (Faker $faker){
    return [
        'barcode'      => $faker->numberBetween(100000000, 20000000),
        'product_name' => $faker->text(20),
        'description'  => $faker->text(40),
        'expire_date'  => $faker->date(),
        'buy_price'    => $faker->numberBetween(1000, 10000),
        'sell_price'   => $faker->numberBetween(1000, 10000),
        'quantity'     => $faker->numberBetween(1, 100),
        'box_id'       => function (){
            return factory('App\Box')->create()->id;
        },
        'seller_id'    => function (){
            return factory('App\Seller')->create()->id;
        },
        'category_id' => function () {
            return factory('App\Category')->create()->id;
        }
    ];
});

$factory->define(Category::class, function (Faker $faker){
    $name = $faker->word;
    
    return [
        'name' => $name,
        'slug' => $name
    ];
});
