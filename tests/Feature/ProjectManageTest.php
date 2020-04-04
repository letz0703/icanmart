<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectManageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_create_project()
    {
        $attributes = [
            'title' => 'project title',
            'description' => 'project description'
        ];

        $endpoint = '/projects';

        $this->post($endpoint, $attributes);

        $this->get($endpoint)->assertSee($attributes['title']);
    }

    /** @test */
    public function user_can_view_a_project()
    {
        $project = create(Project::class);
        $this->get($project->path())
             ->assertSee($project->title);
    }

    /** @test */
    public function a_project_can_have_a_task()
    {
        $this->signIn();
        $project = create(Project::class);
        $this->post($project->path().'/tasks',raw(Task::class));
        $this->assertCount(1, $project->tasks);
    }


}
