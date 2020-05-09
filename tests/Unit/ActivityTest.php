<?php

namespace Tests\Unit;

use App\Activity;
use App\Item;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use function tap;

class ActivityTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function creating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activities);
        $this->assertEquals('created_project', $project->activities->last()->description);
    }

    /** @test */
    public function updating_a_project_records_activity()
    {
        $project = ProjectFactory::create();
        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activities);
        $this->assertEquals('updated_project', $project->activities->last()->description);
    }

    /** @test */
    public function creating_a_task_records_activity()
    {
        $project = ProjectFactory::create();
        $project->addTask('go sleep');
        $this->assertCount(2, $project->activities);

        tap($project->activities->last(), function($activity){
            $this->assertEquals('created_task', $activity->description);

        });
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
