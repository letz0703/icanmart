<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_search_items_with_barcode()
    {
        $box = create('App\Box');
        $item = create('App\Item', ['box_id' => $box->id, 'barcode' => 1111]);
        
        $this->get('/items?barcode=1111')
             ->assertSee($item->barcode);
    }
    
    ///** @test */
    //public function user_can_search_items_with_product_name()
    //{
    //    create('App\Item',['product_name' =>'송로' ]);
    //    create('App\Item',['product_name' =>'송로2' ]);
    //    create('App\Item',['product_name' =>'konyak' ]);
    //    $result = $this->get('/api/items');
    //    $this->assertCount(2, $result);
    //}
    //
}
