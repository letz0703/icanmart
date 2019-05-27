<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemManageTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test */
    public function items_in_a_box_can_be_deleted()
    {
        $box = factory('App\Box')->create();
        $item = create('App\Item', ['box_id' => $box->id]);
        
        $this->json('Delete', $box->path() . '/' . $item->id);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
