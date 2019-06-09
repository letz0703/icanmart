<?php

namespace Tests\Unit;

use App\Activity;
use App\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ActivityTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test */
    public function it_records_activity_when_a_box_created()
    {
        $this->signIn();
        $box = factory('App\Box')->create();
        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->id(),
            'type'    => 'created_box',
            'object_id' => $box->id,
            'object_type' => 'App\Box'
        ]);
        
        $activity = Activity::first();
        
        $this->assertEquals($activity->object->id, $box->id);
    }
    
    /** @test */
    public function it_records_when_a_item_is_created()
    {
        $this->signIn();
        create('App\Item');
        
        $this->assertEquals(2, Activity::count());
    }
    
}
