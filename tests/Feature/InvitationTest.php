<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_invited_to_projects()
    {
        $user = $this->signIn();
        $project = ProjectFactory::create();
        $project->invite($user);
        $this->assertCount(1, $project->members);
        $this->get('/projects')
             ->assertSee($project->title);
    }

}
