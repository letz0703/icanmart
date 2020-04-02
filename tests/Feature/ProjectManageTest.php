<?php

namespace Tests\Feature;

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
}
