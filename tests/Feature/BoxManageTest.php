<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxManageTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test */
    public function unauth_user_can_not_add_items_to_any_box()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id' => $box->id]);
        $this->post('/boxes/1/items',[]);
        $this->get($box->path())
             ->assertSee($item->product_name);
    }
    
    
    /** @test */
    public function auth_user_can_add_items_to_a_box()
    {
        $this->be(factory('App\User')->create());
        
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id' => $box->id]);
        
        $this->post('/boxes/' . $box->id . '/items', $item->toArray());
        $this->get($box->path())
             ->assertSee($item->product_name);
    }
    
}
