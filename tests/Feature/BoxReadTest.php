<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoxReadTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    
    public function a_user_can_browse_all_boxes()
    {
        $response = $this->get('/boxes');

        $response->assertStatus(200);
    }
    
    /** @test */
    public function a_user_can_see_items_in_a_box()
    {
        $box = factory('App\Box')->create();
        $item = factory('App\Item')->create(['box_id'=>$box->id]);
        //dd($box->path());
        $this->get($box->path())
             ->assertSee($item->product_name);
    }
    
}
