<?php

use App\Item;
use App\User;
use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Item::truncate();
        
        factory(Item::class)->create([
            'barcode'      => 1234,
            'product_name' => 'konyak jelly',
            'description'  => 'Mannan Life Konyack',
            'expire_date'  => null,
            'buy_price'    => 3000,
            'sell_price'   => 3500,
            'quantity'     => 12,
            'box_id'       => function (){
                return factory('App\Box')->create()->id;
            },
            'user_id'       => function (){
                return factory('App\User')->create()->id;
            },
            'seller_id'    => function (){
                return factory('App\Seller')->create()->id;
            },
            //'category_id' => function () {
            //    return factory('App\Category')->create()->id;
            //}
        ]);
    }
}
