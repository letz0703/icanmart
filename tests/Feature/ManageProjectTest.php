<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

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
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', raw(Project::class) )->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title'       => 'project title',
            'description' => 'project description',
            'notes' => 'General Notes'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
             ->assertSee($attributes['title'])
             ->assertSee($attributes['description'])
             ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $project = create(Project::class,['owner_id' => auth()->id()]);
        $this->patch($project->path(), [
            'title' => 'changed',
            'description' => 'changed',
            'notes' => 'changed',
        ]);
        $this->assertDatabaseHas('projects', [
            'title' => 'changed',
            'description' => 'changed',
            'notes' => 'changed',
        ]);
    }

    /** @test */
    public function auth_user_can_edit_projects()
    {
        $this->signIn();
        $project = ProjectFactory::create();

        $this->get($project->path().'/edit')
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

        $project = create(Project::class, ['owner_id'=>auth()->id()]);
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
        //$this->get('/projects')->assertRedirect('login');
    }

}
