<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function arch_items_with_barcode()
    {
        $box = create('App\Box');
        $item = create('App\Item', ['box_id' => $box->id, 'barcode' => 1111]);
        
        $this->get('/items?barcode=1111')
             ->assertSee($item->barcode);
    }
    
    /** @test */
    //public function a_user_can_search_items()
    //{
    //    config(['scout.driver'=>'algolia']);
    //    $search = 'foobar';
    //    $item = create('App\Item',[],2);
    //    $items = create('App\Item',['product_name' => "foobar"],2);
    //    $results = $this->getJson("/items/search?query={$search}")->json();
    //    $this->assertCount(2, $results);
    //}
}
