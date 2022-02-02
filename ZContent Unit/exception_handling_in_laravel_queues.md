# Exception handling in Laravel Queues

## Goal
-** Understand what to do if an exception occurs during job execution **

## Job retry_after
To automatically retry if an exception occurs during job execution, [`retry_after`] (https://laravel.com/docs/8.x/queues#job-expirations-and-timeouts" Specify it in advance with the doc ").
In your `config/queue.php` configuration file, each queue connection defines a `retry_after` option. This option specifies how many seconds the queue connection should wait before retrying a job that is being processed.

[config / queue.php]

```php
'redis' => [
    'driver' => 'redis',
    'connection' => 'default',
    'queue' => env('REDIS_QUEUE', 'default'),
    'retry_after' => 90, 
    'block_for' => null,
    'after_commit' => false,
        ],
```

In the above code, the following contents are specified.
--If `retry_after` valueis set to 90, the job will be released back onto the queue if it has been processing for 90 seconds without being released or deleted.
Typically, you should set the retry_after value to the maximum number of seconds your jobs should reasonably take to complete processing.

But Also the maximum number of attempts is defined by the --tries switch used on the queue:work Artisan command:

```
$ php artisan queue:work --tries=3
```

By the way, the following are examples of options that can be specified.

--`--delay[=queue]:` The number of seconds to delay failed `jobs default: "0"`
--`--tries:` maximum number of times a job should be attempted
--`--queue:` queue name to be added when retrying
--`--priority:` Priority
--`--timeout[=TIMEOUT]` The number of seconds a child process can run `default: "60"`
--`--sleep[=SLEEP] ` Number of seconds to sleep when no job is available `default: "3"`

## Discard Failed Jobs
When a particular job fails, you may want to send an alert to your users or revert any actions that were partially completed by the job.
To accomplish this, you may define a [failed] (https://laravel.com/docs/8.x/queues#cleaning-up-after-failed-jobs "doc") method on your job class.

[app/ jobs/ asyncLog.php]

```php
#omit
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
```
To view all of the failed jobs that have been inserted into your [failed_jobs] (https://laravel.com/docs/8.x/queues#retrying-failed-jobs "doc") database table, you may use the `queue:failed` Artisan command:

```
$ php artisan queue:failed
```

To retry all of your failed jobs, execute the `queue:retry` command and pass `all` as the ID:

```
$ php artisan queue:retry all
```

If you would like to delete a failed job, you may use the `queue:forget` command:

```
$ php artisan queue:forget 91401d2c-0784-4f43-824c-34f94a33c24d
```
The `91401d2c-0784-4f43-824c-34f94a33c24d` string after `queue:forget` command is the specific ID of on of the failed jobs identified using the above command to check for all failed jobs.

To delete all of your failed jobs from the `failed_jobs` table, you may use the `queue:flush` command:

```
$ php artisan queue:flush
```
When using `Horizon`, you should use the `horizon:forget` command to delete a failed job instead of the `queue:forget` command.

## summary
-** For exception handling in asynchronous processing, you can specify whether to specify retry with `retry_after` or discard with` queue:flush` command. ** **