<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
    
    /** @test */
    public function user_can_add_image_for_an_item()
    {
        $this->signIn();
        $item = create('App\Item');
        
        Storage::fake('public');
        
        $this->json('POST', '/items/' . $item->id . '/image', [
            'image' => $file = UploadedFile::fake()->image('list-image.jpg'),
        ]);
        
        //dd($item->fresh()->image_path);
        //$this->assertEquals('images/' . $file->hashName(), $item->fresh()->image_path);
        
        Storage::disk('public')->assertExists('images/' . $file->hashName());
    }
    
    /** @test */
    public function a_user_can_determine_image_path()
    {
        $item = create('App\Item');
        $this->assertEquals('images/default.gif', $item->image());
        $item->image_path = 'images/letz.jpg';
        $this->assertEquals('images/letz.jpg', $item->image());
    }
    
}
