<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tasks;

class TaskTesh extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_if_the_task_title_is_empty_string(){
        // tests goes here
        $task = Tasks::make(['title'=>'']);
        $this->assertTrue($task->title === "");
    }
}
