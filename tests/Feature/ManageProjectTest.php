<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_create_project()
    {
        $this->signIn();

        $attributes = [
            'title'       => 'project title',
            'description' => 'project description',
        ];

        $this->post('/projects', $attributes);
        $this->assertDatabaseHas('projects', $attributes);

        //$this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function user_can_view_a_project()
    {
        $this->signIn();

        $project = create(Project::class);
        $this->get($project->path())
             ->assertSee($project->title);
    }

    /** @test */
    public function guest_cannot_view_projects()
    {
        $project = raw(Project::class);
        $this->post('/projects', $project)->assertRedirect('/login');
        //$this->get('/projects')->assertRedirect('login');
    }


    /** @test */
    public function a_project_can_have_a_task()
    {
        $this->signIn();
        $project = auth()->user()->projects()->create(raw(Project::class));
        $this->post($project->path() . '/tasks', raw(Task::class));
        $this->assertCount(1, $project->tasks);
    }


    /** @test */
    public function user_can_add_a_task()
    {
        $this->signIn();
        $project = create(Project::class, ['owner_id' => auth()->id()]);
        $this->post($project->path() . '/tasks', ['body' => 'test tasks']);
        $this->assertCount(1, $project->tasks);
        //->assertStatus(403);
        //$this->assertDatabaseMissing('tasks', ['body' => 'test tasks']);
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(raw(Project::class));

        $task = $project->addTask('new project');


        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body'      => 'changed',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body'      => 'changed',
            'completed' => true,
        ]);
    }

    /** @test */
    public function only_the_project_owner_may_update_tasks()
    {

        $this->signIn();

        $project = create(Project::class);

        $task = $project->addTask('task by other uer');

        $this->patch($project->path() . '/tasks/'.$task->id, raw(Task::class))
             ->assertStatus(403);

    }

}
