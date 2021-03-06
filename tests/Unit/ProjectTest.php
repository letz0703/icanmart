<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_path()
    {
        $project = create(Project::class);
        $this->assertEquals('/projects/'.$project->id, $project->path());
    }


    /** @test */
    public function it_has_title()
    {
        $project = create(Project::class,['title'=>'title', 'description'=>'description']);
        $this->assertDatabaseHas('projects', ['title'=>$project->title]);
    }

    /** @test */
    public function it_has_description()
    {
        $project = create(Project::class,['title'=>'title', 'description'=>'description']);
        $this->assertDatabaseHas('projects', ['description'=>$project->description]);
    }

    /** @test */
    public function it_can_add_add_a_task()
    {
        $this->signIn();
        $project = create(Project::class);
        $project->addTask('project body');
        //$this->assertInstanceOf(Collection::class, $project->tasks);
        $this->assertCount(1, $project->tasks);
    }

    /** @test */
    public function project_belongs_to_an_owner()
    {
        $project = create(Project::class);
        $this->assertInstanceOf('App\User', $project->owner);
    }

    /**test */
    public function it_can_invite_users()
    {
        $project = ProjectFactory::create();
        $project->invite($user = factory('App\User')->create());

        $this->assertTrue($project->members->contains($user));
    }


}
