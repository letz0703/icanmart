<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_invite_users()
    {
        $user = $this->signIn();

        $project = factory(Project::class)->create();

        $project->invite($newUser = factory(User::class)->create());

        $this->be($newUser)
            ->post(action('ProjectTaskController@store', $project), $task = [
                'body'=>'Foo Task'
            ]);

        $this->assertDatabaseHas('tasks', $task);
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
