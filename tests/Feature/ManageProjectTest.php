<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use function factory;

class ManageProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function guests_cannot_manage_projects()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects/edit')->assertRedirect('login');
        $this->get($project->path() . '/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', raw(Project::class))->assertRedirect('login');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_any_project()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
             ->assertRedirect('login');

        $user = $this->signIn();

        $this->delete($project->path())
             ->assertStatus(403);

        $project->invite($user);

        $this->be($user)->delete($project->path())
             ->assertStatus(403);

    }

    /** @test */
    public function auth_user_can_delete_own_projects()
    {
        $project = ProjectFactory::create();

        $this->be($project->owner)
             ->delete($project->path())
             ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }


    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $this->followingRedirects()
             ->post('/projects', $attributes = factory(Project::class)->raw())
             ->assertSee($attributes['title'])
             ->assertSee($attributes['description'])
             ->assertSee($attributes['notes']);
    }

    /** @test */
    function tasks_can_be_included_as_part_a_new_project()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw();
        $attributes['tasks'] = [
            ['body' => 'task1 body'],
            ['body' => 'task2 body'],
        ];

        $this->post('/projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $this->patch($project->path(), $attributes = [
            'title'       => 'changed',
            'description' => 'changed',
            'notes'       => 'changed',
        ]);
        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function auth_user_can_update_the_general_notes_of_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->be($project->owner)
             ->patch($project->path(), ['notes' => 'changed']);

        $this->assertDatabaseHas('projects', [
            'notes' => 'changed',
        ]);
    }

    /** @test */
    public function auth_user_can_edit_projects()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = ProjectFactory::create();

        $this->get($project->path() . '/edit')
             ->assertOk();
    }


    /** @test */
    public function an_auth_user_cannot_update_others_project()
    {
        $this->signIn();
        $project = create(Project::class);
        //dd($project->path());
        $this->patch($project->path())
             ->assertStatus(403);
    }

    /** @test */
    public function user_can_only_view_their_project()
    {
        $this->signIn();

        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $projectByOthers = create(Project::class);
        $this->get($project->path())
             ->assertSee($project->title);
        $this->get($projectByOthers->path())
             ->assertStatus(403);
    }


    /** @test */
    public function guest_cannot_view_projects()
    {
        $project = raw(Project::class);
        $this->post('/projects', $project)->assertRedirect('/login');
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function user_can_view_invited_to_projects()
    {
        $user = $this->signIn();

        $project = ProjectFactory::create();

        $project->invite($user);

        $this->assertCount(1, $user->accessibleProjects());
    }


}
