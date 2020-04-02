<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

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

}
