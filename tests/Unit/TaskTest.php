<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testCanBeCreateTask()
    {
        $response = $this->post('/api/task', [
            'name' => 'Test Task',
            'description' => 'Test Description',
            'file_url' => 'http://www.africau.edu/images/default/sample.pdf'
        ])->assertStatus(201);
    }

    public function testCannotBeCreatedTaskFromInvalidStatusName()
    {
        $response = $this->post('/api/task', [
            'name' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'invalid_status',
            'file_url' => 'http://www.africau.edu/images/default/sample.pdf'
        ])->assertStatus(400);
    }

    public function testCannotBeCreatedTaskFromInvalidParams()
    {
        $response = $this->post('/api/task', ['name' => null])
            ->assertStatus(400);
    }

    public function testCannotBeCreatedTagFromInvalidTaskId()
    {
        $response = $this->post('/api/task/1244-412-21312-dfff/tag', ['tag_name' => 'Test Tag Name'])
            ->assertStatus(404);
    }
}
