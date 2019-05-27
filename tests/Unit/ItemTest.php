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
    public function it_belongs_to_category()
    {
        $item = create('App\Item');
        $this->assertInstanceOf('App\Category', $item->category);
    }
    
    /** @test */
    //public function it_can_make_a_string_path()
    //{
    //    $item = create('App\Item');
    //    $this->get($item->path(), $item->toArray());
    //    $this->assertEquals($item->path(), "/items/{$item->category->slug}/{$item->id}");
    //}
    
    /** @test */
    public function it_has_a_seller()
    {
        $item = factory('App\Item')->create();
        $this->assertInstanceOf('App\Seller', $item->seller);
    }
    
    /** @test */
    public function it_requires_a_valid_seller_id()
    {
        factory('App\Seller', 2)->create();
        
        $this->postItem(['seller_id' => null])
             ->assertSessionHasErrors('seller_id');
        $this->postItem(['seller_id' => 999])
             ->assertSessionHasErrors('seller_id');
    }
    
    public function postItem($overrides = [])
    {
        $this->signIn()->withExceptionHandling();
        
        $item = make('App\Item', $overrides);
        
        return $this->post('/items', $item->toArray());
    }
    
    ///** @test */
    //public function un_auth_user_can_not_browse_items()
    //{
    //    $this->expectException('Illuminate\Auth\AuthenticationException');
    //    $this->get('/items');
    //}
    
    /** @test */
    public function users_can_browse_all_items()
    {
        //$this->be(factory('App\User')->create());
        //$this->signIn();
        //$item = factory('App\Item')->create();
        $response = $this->get('/items');
        $response->assertStatus(200);
    }
    
    /** @test */
    public function an_item_has_a_profile()
    {
        $item = create('App\Item');
        $this->get("/items/profile/1")
             ->assertSee($item->product_name);
    }
    
    /** @test */
    public function profile_shows_purchase_history_of_the_item()
    {
        $item = create('App\Item');
        $this->get("/items/profile/{$item->id}")
             ->assertSee($item->box->seller_name);
    }
    
    
}
