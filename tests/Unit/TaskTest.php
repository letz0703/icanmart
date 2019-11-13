<?php

namespace Tests\Unit;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use function create;
use function with;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_body()
    {
        $task = create(Task::class);
        $this->assertInstanceOf('App\Task', $task);
    }
    
    public function user_can_post_task()
    {
        $this->signIn();
        
        $this->withExceptionHandling();
        $task = make('App\Task');
        $this->post('/icanmart/tasks')
             ->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
    
}
