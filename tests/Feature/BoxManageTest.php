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
        $box = factory('App\Box')->make();
        //dd($box);
        $response = $this->post('/boxes', $box->toArray());
        //dd($response->headers->get('Location'));
        $this->get($response->headers->get('Location'))
             ->assertSee($box->title);
             //->assertSee($box->seller->name);
        //$this->get($box->path())
        //     ->assertSee($box->title);
    }
    
    
    /** @test */
    public function unauth_user_can_not_add_items_to_any_box()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $box = factory('App\Box')->create();
        //$item = factory('App\Item')->create(['box_id' => $box->id]);
        $this->post($box->path().'/items', [])
             ->assertRedirect('login');
             //->assertSee($item->product_name);
    }
    
    
    /** @test */
    public function admin_can_add_items_to_a_box()
    {
        $this->signInAdmin();
        $box = create('App\Box');
        $this->post('/boxes', $box->toArray());
        $this->assertDatabaseHas('boxes', ['id' => $box->id]);
        
        $item = make('App\Item',['box_id'=>$box->id]);
        $response = $this->postJson('/boxes/'.$box->seller.'/'.$box->slug.'/items', $item->toArray())
             ->json();
        $this->assertCount(1, $box->fresh()->items);
    }
    
    /** @test */
    public function guest_may_not_delete_any_box()
    {
        $this->withExceptionHandling();
        $box = factory('App\Box')->create();
        //$response = $this->json('Delete',$box->path());
        $response = $this->delete($box->path());
        $response->assertRedirect('login');
    }
    
    /** @test */
    public function a_box_can_be_deleted()
    {
        $this->signIn();
        
        $box = factory('App\Box')->create();
        $item = create('App\Item',['box_id'=>$box->id]);
        
        $response = $this->json('Delete',$box->path());
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('boxes',['id' => $box->id]);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
        
    }
    /** @test */
    public function unauth_user_cannot_update_boxes()
    {
        $this->withExceptionHandling();
        $box = create('App\Box');
        $this->patch("/boxes/{$box->id}/")
             ->assertRedirect('/login');
       $this->signIn()->patch("/boxes/{$box->id}/payment")
             ->assertStatus(404);
        //$this->assertDatabaseHas('boxes',['id' => $box->id, 'paid' => true]);
    }
    
    ///** @test */
    //public function auth_user_can_update_paid_status_of_boxes()
    //{
    //    $this->signIn();
    //    $box = create('App\Box',['user_id' => auth()->id(), 'paid' => false]);
    //
    //    $this->patch("/boxes/{$box->id}/payment",['paid' => true]);
    //
    //    $this->assertDatabaseHas('boxes',['id' => $box->id, 'paid' => true]);
    //}
    
    /** @test */
    public function auth_user_can_update_box_amount()
    {
        $this->signIn();
        $box = create('App\Box',['user_id' => auth()->id()]);
        //dd($box);
        $this->patch($box->path(),['amount' => 2000]);
        $this->assertDatabaseHas('boxes',['id'=>$box->id, 'amount' => 2000]);
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
