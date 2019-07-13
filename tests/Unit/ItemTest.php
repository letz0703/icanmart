<?php

namespace Tests\Unit;

use App\Notifications\BoxWasCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;

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
    public function profile_shows_box_purchase_history()
    {
        $item = create('App\Item');
        $this->get("/items/profile/{$item->id}")
             ->assertSee($item->box->seller_name);
    }
    
    /** @test */
    public function it_know_its_inventory_quantity()
    {
        $item = create('App\Item');
        $this->assertCount(1, $item->inventories);
        $this->assertEquals($item->quantity, $item->inventories->first()->quantity);
    }
    
    /** @test */
    public function its_inventory_quantity_is_increase_when_the_same_barcoded_item_is_added()
    {
        $item = create('App\Item',['barcode'=>1234, 'quantity'=>10]);
        create('App\Item',['barcode'=>1234, 'quantity'=> 30]);
        $this->assertEquals(40, $item->inventories->first()->quantity);
    }
    
    /** @test */
    public function it_know_minimum_stock_quantity()
    {
        $item = create('App\Item');
        $msq = $item->inventories->first()->update(['minimum_stock_quantity'=>10]);
        $this->assertEquals(10, $item->inventories->first()->minimum_stock_quantity);
    }
    
    /** @test */
    public function it_can_notice_user()
    {
        //dd($box);
        $this->signIn();
        $this->assertCount(0, auth()->user()->notifications);
        $box = create('App\Box',[
            'user_id' => 1000
        ]);
        $this->post("/boxes",$box->toArray());
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }
    
    
    
    
    
    ///** @test */
    //public function items_can_be_sold()
    //{
    //    $bongji = create('App\Bongji');
    //    $item = create('App\Item');
    //    $this->post('/bongi/create');
    //    $this->assertSee($bongji->amount);
    //}
    
    
    
}
