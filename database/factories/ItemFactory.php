<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

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

$factory->define(Item::class, function (Faker $faker) {
    return [
        'barcode' => $faker->numberBetween(100000000,20000000),
        'product_name' => $faker->text(20),
        'description' => $faker->text(40),
        'expire_date' => $faker->date(),
        'buy_price' => $faker->numberBetween(1000,10000),
        'sell_price' => $faker->numberBetween(1000,10000),
        'quantity' => $faker->numberBetween(1,100),
    ];
});
