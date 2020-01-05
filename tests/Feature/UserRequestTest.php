<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use function factory;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_make_questions()
    {
        $user_request = factory('App\UserRequest')->create();
        $this->post('/contact', $user_request->toArray());
        $this->assertDatabaseHas('user_requests', ['name'=>$user_request->name]);
    }

    /** @test */
    public function request_should_be_verified()
    {
        $user_request = factory('App\UserRequest')->make(['verification'=>5]);
        $this->post('/contact', $user_request->toArray());
        $this->assertDatabaseHas('user_requests', [
            'verification' => 5
        ]);
    }

}
