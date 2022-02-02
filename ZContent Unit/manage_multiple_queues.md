
# Manage multiple queues

## Goal
-** You will be able to set and execute a queue other than the default **

## To manage multiple queues
Laravel Queues can handle multiple queues on the backend. It is useful to have separate queues to make it easier to keep track of jobs on the queue.
To specify the queue to add to for each job class, add it to the `queue` with which you want to be dispacthed on by using the `onQueue` method.

For example:

```php
// This job is sent to the default queue...
Job::dispatch();

// This job is sent to the "emails" queue...
Job::dispatch()->onQueue('emails');
```

[app / jobs / asyncLog.php]

```php
#omit
class asyncLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Message::dispatch()->onQueue('async_logs');
    }
}
```

If you add a job using `asyncLog` in this state, it will be added to the queue called` async_logs`. However, at this stage, the queues handled by Laravel Queues are still separated. Therefore, you need to configure Laravel Horizon and redis, the backend that actually processes the job, to manage multiple queues.
To do this you may wish to prioritize how your queues are processed. For example, in your `config/queue.php` configuration file, you may set the default `queue` for your `redis` connection to `low` or `high`.

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

However, occasionally you may wish to push a job to a `high` priority queue like so:

```php
dispatch((new Job)->onQueue('high'));
```
To start a worker that verifies that all of the `high` queue jobs are processed before continuing to any jobs on the `low` queue, pass a comma-delimited list of queue names to the `work` command:

```
$ php artisan queue:work --queue=high,low
```

## summary
-** Laravel Queues can handle multiple queues. ** **