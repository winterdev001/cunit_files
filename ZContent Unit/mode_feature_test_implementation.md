# Model/ Feature Test implementation

## Issue recommended version

**When submitting an assignment, please submit it in the following version.**

```bash
PHP 8.1.1
Laravel 8.0
```

## Purpose of the PHPUnit Introductory Series Assignment

Series assignments are for determining if you have achieved the goals of the series.
It was

**Goals of PHPUnit Introductory Series**
--Understanding the need for testing
--Tested with System Unit Test

## Problem

In this task, you will create a test using the task management application used in "Basic Writing of Model/ Feature Test" in the "Introduction to Spec Series".
Delete the test code of `tests / Feature / TaskTest.php` written so far and paste the following code.

[tests / Feature / TaskTest.php]

```php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;

class TasksTest extends TestCase
{
   public function test_If_no_title_is_entered_task_validation_is_invalid()
    {
        $task = [
            'title'=>'',
            'description'=>'test',
            'status'=>'todo',
            'deadline'=>'2022-01-24'
        ];

        $response = $this->post(route('savetasks'),$task);

        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);
    }

    public function test_If_no_status_is_entered_task_validation_is_invalid()
    {
        $task = [
            'title'=>'test',
            'description'=>'test',
            'status'=>'',
            'deadline'=>'2022-01-24'
        ];

        $response = $this->post(route('savetasks'),$task);

        $response->assertSessionHasErrors([
            'status' => 'The status field is required.'
        ]);
    }

   public function test_If_the_completion_deadline_is_not_entered_task_validation_is_invalid (){

   }

   public function test_If_the_completio_deadline_is_in_the_past_the_task_validation_is_invalid (){

   }

   public function test_If_the_completion_deadline_is_todays_date_task_validation_is_valid (){

   }
}
```

In the text, I created the above tests, "If the title is not entered, the task validation is invalid" and "If the status is not entered, the task validation is invalid". Complete the remaining 3 tests and take a screenshot of the execution result as shown below.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/1fc6abc5dfab311b3400207c384bda7c.png)] (https://diveintocode.gyazo.com/1fc6abc5dfab311b3400207c384bda7c)

## Pass requirements

1. All tests use the `assertSessionHasErrors` and `assertSessionHasNoErrors` method
2. All tests have been verified for validation errors.
3. It is verified whether the error message when a validation error occurs is as expected.
4. Screenshots of all successful tests have been submitted

## Submission method

1. Create a remote repository on GitHub (repository name is arbitrary)
1. Push the code to the remote repository you created
1. Submit the URL of the repository from the [Submission page] (https://diver.diveintocode.jp/submissions/new).
1. Attach the screenshot to the comment section