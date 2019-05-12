<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemReadTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function items_can_be_filtered_by_barcode()
    {
        $itemWithBarcode = factory('App\Item')->create(['barcode' => '1234']);
        $itemWithOtherBarcode = factory('App\Item')->create();
        //dd($itemWithBarcode);
        $this->get('/items?barcode=1234')
             ->assertSee($itemWithBarcode->product_name)
             ->assertDontSee($itemWithOtherBarcode->product_name);
    }
    
    
}
