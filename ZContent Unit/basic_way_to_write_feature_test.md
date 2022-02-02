#Basic way to write Model/ Feature Test

## Goal
-** You will be able to write the basic syntax of Model/Feature Test **

## Check the application under test

In this text, we will describe the Model/Feauture Test in the task management application.
The target application is designed to set the task status and completion deadline.
The task management application is saved in the following repository, so please access it.
https://github.com/diveintocode-corp/cdp_web_model_spec_practice

Refer to the README environment construction command and execute the following command to start the application.
```
# In the command below, multiple commands are executed together, separated by a semicolon. This time I created a directory and moved to it.
$ mkdir -p ~ / workspace / dive-into-code / tests; cd $ _
$ git clone git@github.com:diveintocode-corp/cdp_web_model_spec_practice.git
$ cd cdp_web_model_spec_practice
$ composer install
$ npm install or yarn  //use either npm or yarn depending on which package manager you're using
$ copy .env.example .env
$ php artisan key:generate
```

Open your `.env` file and change the database name `(DB_DATABASE)` to whatever you have,
username `(DB_USERNAME)` and password `(DB_PASSWORD)` field correspond to your configuration.

```
$ php artisan migrate
$php artisan serve
```

You can check the task list screen at `localhost: 8000 / tasks`.
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/844628817228920f718b1e9963fe671e.gif)] (https://diveintocode.gyazo.com/844628817228920f718b1e9963fe671e)

## Consider a Model/ Feature Test test case

This time, we will use the following points as test cases for the behavior when creating a task.

--If no title is entered, task validation is invalid.
--If no status is entered, task validation is invalid.

## About the basic methods used in the test code

Execute the command `php artisan make:test test_file_name --model = model_name` to generate a file that serves as a template for Model/Feature Test.

```
$ php artisan make:test TaskTest --model = task
```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/00a869f025c8e699278687c84b8789fb.gif)] (https://diveintocode.gyazo.com/00a869f025c8e699278687c84b8789fb)

In Feauture Test, it is common to enclose the test code in a specific syntax (`public function test_test_name`) for easy management later, and it is written as shown below:

```php

public function test_example(){
    //assertions and test code goes here
}

```

The only methods that PHPUnit will recognize as tests are those with names starting with `test`. 

```php
  public function test_If_no_title_is_entered_task_validation_is_invalid(){
      //test code goes here
  }

  public function test_If_no_status_is_entered_task_validation_is_invalid(){
      //test code goes here
  }

```

The test code for confirming validation is described in the following flow.
1. Prepare the test data to be confirmed
2. Determine the result of validation
3. In case of an error, check the content of the error message as well.

For test data, create an array with task's field and set the value of the attribute corresponding to each column ..
Validation results and error message content use verification methods called `assertSessionHasErrors`.

You can write a test to determine the expected value and result in the form `assertSessionHasErrors(['key' => 'value'])`.
There is many assertions often used to check the equality between current content to the new provided contents .

Specifically, the test is described in combination as shown below.
```
assertSessionHasErrors(['key' => 'value']) # Assert that the session has validation errors
assertSessionHasNoErrors() # Assert that the session has no validation errors

```

Assertions have other methods to make sure they contain specific strings or numbers, such as `assertEquals` and` assertContains`.
See the Reference for othe assertions (https://phpunit.readthedocs.io/en/9.5/ "doc") for more information.

## Write the code of Model/ Feature Test

Overwrite the following contents with the `tests / Feature / TaskTest.php` file created by the` php artisan make:test TaskTest` command.

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

This test code confirms with the `assertSessionHasErrors` assertion that the result from the validations is equal to the array value passed inside it.
The code for `assertSessionHasErrors(['title' => 'The title field is required.']);` expect the result that will be returned from validations rules will throw a message `The title field is required`.

We also check the content of the validation error message and confirm that only the validation of the expected item fails.

Run the `php arttisan test tests/Feature/TaskTest.php` command to verify that the test succeeds.

```
$ php arttisan test tests/Feature/TaskTest.php
```
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/060533e0fe2a6b53ca64c3a9304bd9f0.png)] (https://diveintocode.gyazo.com/060533e0fe2a6b53ca64c3a9304bd9f0)

As a result of executing `2 examples, 0 failures` and 2 examples, the number of failed cases is displayed as 0.

Also, deliberately comment out some of the validations in your controller as shown below to make sure the corresponding test fails.

[app/ Http/ Controllers/ TasksController.php]

```php
#omit
class TasksController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required',
            'status' => 'required',
            'deadline' => 'required|after_or_equal:today'
        ]);

        #omit
        
    }
}
```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/34bce56ace26eb09f63ebdf95f2d5414.png)] (https://diveintocode.gyazo.com/34bce56ace26eb09f63ebdf95f2d5414)

If the implementation code changes in this way, the change can be detected by the test code failing.

## summary
-** In PHPUnit, the test case you want to check is expressed using the syntax `public function test_test_name`. ** **
-** PHPUnit allows you to write tests that compare expected values with results using matchers/assertions such as `assertEquals` and ` assertContains`. ** **
-** In Model/ Feature Test, test is described in the format of creating test data, executing the process you want to check, and judging the result. ** **