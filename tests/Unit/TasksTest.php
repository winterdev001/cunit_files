<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TasksTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_it_stores_new_tasks()
    // {
    //     $response = $this->post('/tasks',[
    //         'title'=>'PHP',
    //         'content'=>'Learn PHP'
    //     ]);

    //     $response->assertStatus(200);
    // }

    #Tasks containing the search word will be narrowed down
    // public function test_Fuzzy_search_for_title_in_scope_method()
    //   {
    // $first_task = Task::make(['title'=>'first_task_title']);
    // $second_task = Task::make(['title'=>'second_task_title']);
    // $third_task = Task::make(['title'=>'third_task_title']);
    //     # Example code when the title search method is defined with scope as seach_title
    //     # Insert the search word into the search method defined with scope.
    //     # Use the assertions to check both what was searched and what was not.
    //     # Check the number of test data that were retrieved
    //     $this->assertTrue($first_task->title === "first_task_title");
    //     $this->assertTrue($first_task->title !== "second_task_title");
    //     $this->assertTrue($first_task->title !== "third_task_title");
    //     $this->assertCount(1,$first_task->toArray());        
    // }

    public function test_A_list_of_registered_tasks_is_displayed()
    {   
        // $task = Task::create([
        //     'title'=>'Create documents',
        //     'content'=>'Create a proposal.',
        //     'status'=>'available',
        //     'priority'=>'low'
        // ]);

        $repsonse = $this->get('/tasks');
        $repsonse->assertSeeText('Document creation');
    }

    public function test_If_no_title_is_entered_task_validation_is_invalid()
    {
        $task = [
            'title'=>'',
            'content'=>'Clean book shelves',
            'status'=>'available',
            'priority'=>'low',
            'deadline'=>'2022-01-27'
        ];

        $response = $this->post(route('savetasks'),$task);

        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);
    }
}
