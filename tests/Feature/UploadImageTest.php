<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function only_members_can_upload_image()
    {
        $this->withExceptionHandling();
        $this->json('POST', '/items/1/image')
             ->assertStatus(401); // Unauthorized
    }
    
    /** @test */
    public function a_valid_image_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();
        
        $item = create('App\Item');
        $this->json('POST', '/items/' . $item->id . '/image', [
            'image' => 'not-an-image',
        ])->assertStatus(422); // Unprocessible Entity
    }
    
    
}
