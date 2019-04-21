<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxtTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_belongs_to_a_seller()
    {
        $box = factory('App\Box')->create();
        $this->assertInstanceOf('App\Seller', $box->seller);
    }
    
    /** @test */
    public function a_box_has_items()
    {
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id'=>$box->id]);
        $this->assertInstanceOf(Collection::class, $box->items);
    }
    
}
