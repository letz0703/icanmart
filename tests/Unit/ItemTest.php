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
        //$item = factory('App\Item')->create();
        $item = create('App\Item');
        $this->assertInstanceOf('App\Box', $item->box);
    }
    
    /** @test */
    public function it_has_a_seller()
    {
        $item = factory('App\Item')->create();
        $this->assertInstanceOf('App\Seller',$item->seller);
    }
    
    /** @test */
    //public function un_auth_user_can_not_browse_items()
    //{
    //    $this->expectException('Illuminate\Auth\AuthenticationException');
    //    $this->get('/items');
    //}
    
    /** @test */
    public function auth_user_can_browse_all_items()
    {
        //$this->be(factory('App\User')->create());
        $this->signIn();
        //$item = factory('App\Item')->create();
        $response = $this->get('/items');
        $response->assertStatus(200);
    }
}
