<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_belongs_to_a_box()
    {
        $item = factory('App\Item')->create();
        $this->assertInstanceOf('App\Box', $item->box);
    }
    
    /** @test */
    public function it_has_a_seller()
    {
        $item = factory('App\Item')->create();
        $this->assertInstanceOf('App\Seller',$item->seller);
    }
    
    
    /** @test */
    public function user_can_browse_all_items()
    {
        $item = factory('App\Item')->create();
        $response = $this->get('/items');
        $response->assertStatus(200);
    }
}
