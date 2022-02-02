# Laravel Queues test

## Goal
-** You can write a test for Laravel Queues **

## How to write a test for Laravel Queues
When writing a test with PHPUnit for Laravel Queues, prepare a test file under the `tests / Unit /` directory.
The `php artisan make:test asyncLogTest --u` command you have run so far should have generated a test file` spec / Unit / asyncLogTest.php`, so use that file.

Write the test code as follows.

[tests / Unit / asyncLogTest.php]

```php
<?php

namespace Tests\Unit;

use App\Jobs\asyncLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class asyncLogTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_job_are_added_to_the_queue(){
        // Fake Queue functionality
        Queue::fake();

        // Assert a job was pushed to a given queue...
        Queue::assertPushedOn('async_logs', Message::class);
    }
}

```
For more information, please refer to the official documentation below.

-[Queue Fake] (https://laravel.com/docs/8.x/mocking#queue-fake"doc")

## summary
-** Create a test file for Laravel Queues by preparing a test file under the `tests / Unit /` directory. ** **