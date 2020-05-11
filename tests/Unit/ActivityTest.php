<?php

namespace Tests\Unit;

use App\Activity;
use App\Item;
use App\Project;
use App\Task;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use function tap;

class ActivityTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $project = factory(Project::class)->create();

        $activity = $project->activities->first();

        $this->assertInstanceOf(User::class, $activity->user);
    }


    /** @test */
    public function creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activities);
        tap($project->activities->last(), function($activity){
            $this->assertEquals('created_project', $activity->description);
            $this->assertNull($activity->changes);
        });
    }

    /** @test */
    public function updating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $originalTitle = $project->title;

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        tap($project->activities->last(), function($activity) use ($originalTitle){
            $this->assertEquals('updated_project', $activity->description);
            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    public function creating_a_task_records_activity()
    {
        $project = ProjectFactory::create();
        $project->addTask('go sleep');
        $this->assertCount(2, $project->activities);

        tap($project->activities->last(), function($activity){
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('go sleep', $activity->subject->body);
        });
    }

    /** @test */
    public function completing_a_task_records_activity()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->assertFalse($project->tasks->last()->completed);

        tap($project->tasks->last(), function($task) use ($project){
            $this->be($project->owner)
                 ->patch($task->path(), [
                     'body' => 'foo bar',
                     'completed' => true
                 ]);

            $this->assertDatabaseHas('project_activities',['description'=>'completed_task']);
        });

        //$this->assertTrue($project->tasks->last()->toArray());

        //$this->assertEquals('completed_task', $project->activities->last()->description);
    }




    ///** @test */
    //public function it_records_activity_when_a_box_created()
    //{
    //    $this->signIn();
    //    $box = factory('App\Box')->create();
    //    $this->assertDatabaseHas('activities', [
    //        'user_id' => auth()->id(),
    //        'type'    => 'created_box',
    //        'object_id' => $box->id,
    //        'object_type' => 'App\Box'
    //    ]);
    //
    //    $activity = Activity::first();
    //
    //    $this->assertEquals($activity->object->id, $box->id);
    //}
    //
    ///** @test */
    //public function it_records_when_a_item_is_created()
    //{
    //    $this->signIn();
    //    create('App\Item');
    //
    //    $this->assertEquals(2, Activity::count());
    //}
    //
}
