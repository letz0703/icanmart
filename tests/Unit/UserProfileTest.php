<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');
        //dd($user->name);
        $box = create('App\Box', ['user_id'=>$user->id]);
        $this->get("/profiles/{$user->name}")
             ->assertSee($user->name);
             //->assertSee($box->title);
    }
    
    /** @test */
    public function profiles_display_all_boxes_created_by_the_associated_user()
    {
        $this->signIn();
        $box = create('App\Box',['user_id'=>auth()->id()]);
    
        $this->get("/profiles/".auth()->user()->name)
             ->assertSee($box->title);
    }
    
    
    ///** @test */
    //public function profiles_display_all_bongjis_that_user_sold()
    //{
    //
    //}
    
}
