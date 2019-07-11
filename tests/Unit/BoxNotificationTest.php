<?php

namespace Tests\Unit;

use App\Notifications\BoxWasCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class BoxNotificationTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function box_not_sending_notification_to_signed_in_user_when_it_is_created()
    {
        Notification::fake();
        
        $this->signIn();
        create('App\Box');
        
        Notification::assertNotSentTo(auth()->user(), BoxWasCreated::class);
    }
    
    /** @test */
    public function auth_user_receive_notification_when_other_user_create_boxes()
    {
        Notification::fake();
        
        $this->signIn();
        create('App\Box',['user_id' => create('App\User')->id]);
    
        Notification::assertSentTo(auth()->user(), BoxWasCreated::class);
    }
    
}
