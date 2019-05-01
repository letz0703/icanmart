<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class SellerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_seller_has_many_boxes()
    {
        $seller = create('App\Seller');
        $box = create('App\Box',[ 'seller_id'=>$seller->id]);
        //$response = $this->get('/boxes/'.$seller->name);
        $this->assertTrue($seller->boxes->contains($box));
    }
}
