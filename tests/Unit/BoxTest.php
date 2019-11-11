<?php

namespace Tests\Unit;

use App\Box;
use Carbon\Carbon;
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
    public function it_requires_title()
    {
        $this->createBox(['title' => null])
             ->assertSessionHasErrors('title');

    }
    
    /** @test */
    public function it_requires_a_seller()
    {
        $this->createBox(['seller_id' => null])
             ->assertSessionHasErrors('seller_id');
        
    }
    
    public function createBox($overrides = [])
    {
        $this->signIn()->withExceptionHandling();
    
        $box = factory('App\Box')->make($overrides);
    
        return $this->post('/boxes', $box->toArray());
    }
    
    
    /** @test */
    public function a_box_has_items()
    {
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id' => $box->id]);
        $this->assertInstanceOf(Collection::class, $box->items);
    }
    
    /** @test */
    public function it_can_make_a_string_path()
    {
        $this->signIn();
        $box = factory('App\Box')->create();
        $this->post('/boxes', $box->toArray());
        $this->assertEquals($box->path(), "/boxes/{$box->seller->name}/{$box->slug}");
    }
    
    /** @test */
    public function a_box_can_make_a_string_path()
    {
        $box = create('App\Box');
        $this->assertEquals("/boxes/{$box->seller->slug}/{$box->slug}", $box->path());
    }
    
    /** @test */
    public function a_box_requires_unique_slug()
    {
        $this->signIn();
        $box = create('App\Box',[
            'arrived_at' => "2019-08-20",
            'slug' => "2019-08-20"
        ]);
        $this->post(route('boxes'), $box->toArray());
        $this->assertTrue(Box::whereSlug('2019-08-20-2')->exists());
        $this->post(route('boxes'), $box->toArray());
        $this->assertTrue(Box::whereSlug('2019-08-20-3')->exists());
    }
}
