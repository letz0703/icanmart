<?php

namespace Tests\Unit;

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
    }
}
