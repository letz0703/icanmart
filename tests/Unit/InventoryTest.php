<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_barcode_and_quantity()
    {
        $this->signIn();
        $item = create('App\Item', ['barcode' => 1234, 'quantity' => 100]);
        $item->addInventory($item);
        //dd($item->inventories->toArray());
        //$this->assertCount(1, $item->inventories);
        $this->assertDatabaseHas('inventories', ['barcode' => 1234, 'quantity' => 100]);
    }
    
    /** @test */
    
    public function quantity_is_added_when_the_same_barcoded_item_comes()
    {
        $this->signIn();
        $item = create('App\Item', ['barcode' => 1234, 'quantity' => 100]);
        $item->addInventory($item);
        //$this->assertCount(1, $item->inventories);
        $this->assertDatabaseHas('inventories',['quantity' => 100]);
    
        $item2 = create('App\Item', ['barcode' => 1234, 'quantity' => 200]);
        $item2->addInventory($item2);
        
        $this->assertDatabaseHas('inventories',['quantity' => 300]);
        //$item2 = create('App\Item',['barcode'=>1234, 'quantity'=>200]);
        //$item2->addInventory($item2);
        //
        //$this->assertDatabaseHas('inventories',['quantity'=>300]);
        
    }
    
}
