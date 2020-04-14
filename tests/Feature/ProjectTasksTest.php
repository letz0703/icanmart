<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

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
        //$project = app(ProjectFactory::class)->ownedBy($this->signIn())->withTasks(1)->create();
        //$project = ProjectFactory::withTasks(1)->create();

        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
             ->patch($project->tasks()->first()->path(), [
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

        $this->patch($project->path() . '/tasks/' . $task->id, raw(Task::class))
             ->assertStatus(403);
    }
}
