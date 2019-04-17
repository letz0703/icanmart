<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_browse_all_items()
    {
        $item = factory('App\Item')->create();
        $response = $this->get('/items');
        $response->assertStatus(200);
    }
}
