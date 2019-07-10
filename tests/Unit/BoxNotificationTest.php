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
    public function box_send_notification_to_signed_in_user_when_it_is_created()
    {
        Notification::fake();
        
        $this->signIn();
        create('App\Box');
        
        Notification::assertSentTo(auth()->user(), BoxWasCreated::class);
    }
}
