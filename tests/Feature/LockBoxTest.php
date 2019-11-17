<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LockBoxTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function non_administrator_can_not_lock_boxes()
    {
        $this->signIn();
        $box = create('App\Box');
        $this->patch($box->path(), [
            'locked' => true,
        ])->assertStatus(403);
        $this->assertFalse(!! $box->fresh()->locked);
    }
    
    /** @test */
    public function an_administrator_can_lock_boxes()
    {
        $this->signInAdmin();
        $box = create('App\Box', ['user_id' => auth()->id()]);
        //$this->assertFalse($box->locked);
        $this->patch($box->path(), [
            'locked' => true,
        ]);
        $this->assertTrue($box->fresh()->locked, 'Failed Asserting that the box is locked');
    }
    
    /** @test */
    public function an_administrator_can_unlock_boxes()
    {
        $user = $this->signInAdmin();
        $box = create('App\Box');
        $box->lock();
        $this->assertTrue($box->locked);
        $box->unlock();
        $this->assertFalse($box->fresh()->locked);
    }
    
    /** @test */
    public function a_box_may_not_receive_any_items_when_locked()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $box = create('App\Box');
        $box->lock();
        $item = create('App\Item');
        $this->assertTrue($box->locked);
        $response = $this->post($box->path() . '/items', $item->toArray());
        $response->assertStatus(422);
    }
    
    /** @test */
    public function a_box_may_be_locked()
    {
        $box = create('App\Box');
        $this->assertFalse($box->locked);
    }
    
    /** @test */
    public function once_locked_box_may_not_receive_any_item()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $box = create('App\Box');
        $box->lock();
        $item = create('App\Item', ['box_id' => $box->id]);
        $this->post($box->path().'/items',$item->toArray())
            ->assertStatus(422);
    }
    
    
    
    
}
