<?php

namespace Tests\Feature;

use App\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemReadTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function items_can_be_filtered_by_barcode()
    {
        //$itemWithBarcode = factory('App\Item')->create(['barcode' => '1234']);
        $itemWithBarcode = create(Item::class,['barcode'=>'1234']);
        $itemWithOtherBarcode = create(Item::class);
        //dd($itemWithBarcode);
        $this->getJson('/items?barcode=1234')
             ->assertSee($itemWithBarcode->product_name)
             ->assertDontSee($itemWithOtherBarcode->product_name);
    }

    ///** @test */
    //public function a_user_can_filter_items_by_popularity()
    //{
    //    $itemWithThreeOrder = create('App\Item', ['barcode' => '3'], 3);
    //    $itemWithTwoOder = create('App\Item', ['barcode' => '2'], 2);
    //    $itemWithOneOder = create('App\Item', ['barcode' => '1'], 1);
    //
    //    $response = $this->getJson('/items?popular=1')->json();
    //
    //    //$response->assertSeeInOrder([$itemWithThreeOrder->product_name, $itemWithTwoOder->product_name, $itemWithOneOder->product_name]);
    //    $this->assertEquals([3,3,3,2,2,1], array_column($response, 'barcode'));
    //
    //}


}
