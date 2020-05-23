<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function factory;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_invite_users()
    {
        $user = $this->signIn();

        $project = factory(Project::class)->create();

        $userToInvite = factory(User::class)->create();

        $this->be($project->owner)
            ->post($project->path().'/invitations', [
                'email'=> $userToInvite->email
            ]);

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    function the_email_address_must_be_associated_with_valid_birdboard_account()
    {
        //$this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $this->be($project->owner)
            ->post($project->path().'/invitations', [
                'email' => 'notauser@a.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have birdboard account'
            ]);
    }

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
