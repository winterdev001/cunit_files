
# Backend settings
## Goal
-** Can be executed by specifying Laravel Horizon as the backend **

## What is the backend?
The queue to which a job is submitted and the processing system that executes the jobs in the queue are called asynchronous backends (hereinafter referred to as backends) here.
For example, the following asynchronous processing library can be used as a backend in Laravel Queues.

1. [Laravel Inspector] (https://github.com/inspector-apm/inspector-laravel "doc")
  --The package automatically instrument a Laravel application and records performance metrics about HTTP requests, DB queries, Jobs, Commands and more. It also has  a simple API which allows you to monitor any code block in your application.

2. [Hermes] (https://github.com/tomaj/hermes "doc")
  --Hermes provides message broker for sending messages from HTTP thread to offline processing jobs. Recommended use for sending emails, call other API or other time-consuming operations. And also use various message brokers like Redis, rabbit, database, and ability to easily create new drivers for other messaging solutions. And also the simple creation of workers to perform tasks on specified events.

3. [Laravel horizon] (https://github.com/laravel/horizon "doc")
  --provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system such as job throughput, runtime, and job failures.

By default, `sync` is set as the queue adapter.
Sync, or synchronous, is the default queue driver which runs a queued job within your existing process. With this driver enabled, you effectively have no queue as the queued job runs immediately.
However, this can be changed by storing queued jobs in the database. Before enabling this driver, you will need to create database tables to store your queued and failed jobs.


## Set Laravel Horizon on the backend
Here, I will use Laravel Horizon.
You may install Horizon into your project using the Composer package manager:

```
$ composer require laravel/horizon
```

After installing Horizon, publish its assets using the `horizon:install` Artisan command

```
$ php artisan horizon:install
```

Primary configuration file will be located at `config/horizon.php`, after publishing Horizon's assets. This configuration file allows you to configure the queue worker options for your application.

[config/ horizon.php]

```php
'environments' => [
    'production' => [
        'supervisor-1' => [
            'maxProcesses' => 10,
            'balanceMaxShift' => 1,
            'balanceCooldown' => 3,
        ],
    ],

    'local' => [
        'supervisor-1' => [
            'maxProcesses' => 3,
        ],
    ],
],
```

Spring needs to be restarted for the settings to take effect.
Stop Spring running with `bin / spring stop`. You don't need to explicitly start it at this stage as it will be started automatically when you run `rails s` or` rails c`.

## Leverage Docker and Redis environments to run Sidekiq
As mentioned above, Sidekiq requires a Redis environment, so we will prepare this with Docker.
[Redis] (https://redis.io/ "doc") is an in-memory database that handles all data in memory and is open source software.

The databases we have dealt with so far are basically premised on reading and writing to storage, but they have excellent performance because they expand data on memory that can read and write faster.
Although data can be persisted, it is often used as a temporary storage area for the system, and has the best characteristics as a job queue.
Also, the database structure is NoSQL, not the relational database we've been dealing with so far.
See the official documentation for details.

Now, let's prepare a Redis environment using Docker.
Make sure you have created an account on docker hub and enter the following command to get a Docker image and start the container.
If a message indicating that you need to log in is displayed, execute the `docker login` command first.

```console
$ docker pull redis
$ docker run -p 6379: 6379 redis
```

Now you have a Redis environment.
Now let's add the job to the queue.

```php
#omit
class asyncLog implements ShouldQueue
{
    handle()
    {
        Queue::push(new Message());
    }
}
```

The job has not yet run at this stage. This is because the queue processing system has not started.

```sh
$ php artisan queue:work
```

The queue will only run when you start the backend Laravel Horizon process. `php artisan horizon` Please execute and start

```
$ php artisan horizon
```

By the way, Laravel Horizon has a web to check the status of the queue.
It can be used by browsing the following route: [http://localhost:8000/horizon/].

## summary
-** There are several types of asynchronous processing libraries. ** **
-** Laravel Horizon is a library that uses Redis as a queue and can be used via Laravel Queues. ** **