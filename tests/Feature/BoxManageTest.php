<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxManageTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test */
    public function guest_may_not_create_box()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $box = factory('App\Box')->create();
        $this->post('/boxes', $box->toArray());
    }
    
    /** @test */
    public function auth_user_can_create_box()
    {
        $this->actingAs(factory('App\User')->create());
        $box = factory('App\Box')->create();
        //dd($box);
        $this->post('/boxes', $box->toArray());
        $this->get($box->path())
             ->assertSee($box->title);
    }
    
    
    /** @test */
    public function unauth_user_can_not_add_items_to_any_box()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id' => $box->id]);
        $this->post('/boxes/1/items', []);
        $this->get($box->path())
             ->assertSee($item->product_name);
    }
    
    
    /** @test */
    public function auth_user_can_add_items_to_a_box()
    {
        $this->be(factory('App\User')->create());
        
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id' => $box->id]);
        //dd($item);
        $this->post('/boxes/' . $box->id . '/items', $item->toArray());
        $this->get($box->path())
             ->assertSee($item->product_name);
    }
    
    ///** @test */
    //public function user_can_see_sum_of_items_in_a_box()
    //{
    //    $box = create('App\Box');
    //
    //    $items = create('App\Item', [
    //        'box_id' => $box->id,
    //        'buy_price' => 1000,
    //        'quantity' => 2
    //    ], 2);
    //
    //    //$box->amount = $items->amount;
    //
    //    dd($box->amount);
    //    //$this->get($box->path())
    //    //     ->assertEqual('box')
    //}
    
    
}
