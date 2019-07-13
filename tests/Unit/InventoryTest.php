<?php

namespace Tests\Unit;

use App\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_barcode_and_quantity()
    {
        $this->signIn();
        create('App\Item', ['barcode' => 1234, 'quantity' => 100]);
        $this->assertDatabaseHas('inventories', ['barcode' => 1234, 'quantity' => 100]);
    }
    
    /** @test */
    
    public function quantity_is_added_when_the_same_barcoded_item_comes()
    {
        $this->signIn();
        create('App\Item', ['barcode' => 1234, 'quantity' => 100]);
        $this->assertDatabaseHas('inventories',['quantity' => 100]);
        create('App\Item', ['barcode' => 1234, 'quantity' => 200]);
        $this->assertDatabaseHas('inventories',['quantity' => 300]);
    }
    
    /** @test */
    public function it_can_compare_msq_and_current_stock()
    {
        $item = create('App\Item', ['barcode' => 1234, 'quantity' => 100]);
        $itemInventory = $item->inventories->first();
        $itemInventory->setMSQ(110);
        $this->assertTrue(
            $itemInventory->isOutOfStock()
        );
        $itemInventory->setMSQ(50);
        $this->assertFalse(
            $itemInventory->isOutOfStock()
        );
    }
    /** @test */
    public function it_notify_user_when_a_item_is_less_than_msq()
    {
        $this->signIn();
        
        $item = create('App\Item',[
            'seller_id' => 1,
            'product_name' => 'notify msq',
            'barcode' => 1111,
            'quantity' => 2,
        ]);
        $this->assertCount(1, $item->inventories);
        
        $this->post($item->box->path().'/items',[
            'seller_id' => 1,
            'product_name' => 'notify msq',
            'barcode' => 1111,
            'quantity' => 90,
        ]);
        
        $this->assertCount(1, $item->inventories);
    
        //dd(auth()->user()->notifications);
        $this->assertCount(1, auth()->user()->notifications);
    }
    
    /** @test */
    //public function qunaity_is_reduced_when_a_item_is_deleted()
    //{
    //    $item = create('App\Item',[
    //        'product_name' => 'notify msq',
    //        'barcode' => 1111,
    //        'quantity' => 201,
    //    ]);
    //
    //    $this->assertCount(1, $item->inventories);
    //    $item2 = create('App\Item', [
    //        'product_name' => 'notify msq',
    //        'barcode' => 1111,
    //        'quantity' => 99,
    //    ]);
    //
    //    $this->assertDatabaseHas('inventories', ['barcode'=>1111, 'quantity'=>300]);
    //
    //    $item2->delete();
    //    $this->assertDatabaseHas('inventories', ['barcode'=>1111, 'quantity'=>201]);
    //    //$this->assertCount(1, Inventory::where('barcode',1111)->get());
    //}
}
