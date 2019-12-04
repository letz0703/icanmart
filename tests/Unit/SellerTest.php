<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use function factory;

class SellerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_seller_has_many_boxes()
    {
        $seller = create('App\Seller');
        $box = create('App\Box', ['seller_id' => $seller->id]);
        //$response = $this->get('/boxes/'.$seller->name);
        $this->assertTrue($seller->boxes->contains($box));
    }
    
    /** @test */
    public function seller_has_name_and_description()
    {
        $seller = create('App\Seller');
        $this->assertDatabaseHas('sellers', [
            'name'        => $seller->name,
            'description' => $seller->description,
        ]);
    }
    
    /** @test */
    public function seller_has_description()
    {
        $seller = factory('App\Seller')->create([
            'name'        => '5',
            'description' => 'good shop',
            'phone'       => '1234',
        ]);
        
        $this->assertDatabaseHas('sellers', ['description' => $seller->description]);
    }
    
}
