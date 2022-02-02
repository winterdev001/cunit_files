# What is Laravel Queues?

## Goal
-** Asynchronous processing can be implemented using Laravel Queues **

## What is asynchronous processing?
In a program, when a certain process is instructed, it may be executed later instead of being executed immediately. This is called asynchronous processing. Conversely, the process that is executed immediately is called synchronous process.
Asynchronous processing is used for processing that takes a relatively long time, such as sending an email or performing aggregate calculation.

If such a time-consuming process is executed synchronously, it will take a long time to return a response from the request because it cannot proceed until the process is completed.
Asynchronous processing is effective in such cases. When a specific processing instruction that takes a long time is given, the response is returned first while waiting for execution without processing immediately, and then executed asynchronously. This makes it possible to respond faster to the user.

## What is Laravel Queues?
[Laravel Queues] (https://laravel.com/docs/8.x/queues "doc") is a library that provides asynchronous execution processing function 
By using Laravel Queues, various asynchronous execution processes (processes executed on the backend) can be used in a unified manner.

Laravel Queues is responsible for creating and registering asynchronous processes. In other words, it acts like managing asynchronous processing.
Laravel queues provide a unified queueing API across a variety of different queue backends, such as Amazon SQS, Redis, or even a relational database.

## Advance preparation
As a subject, create an application with an asynchronous processing function that saves the passed message in the database.
Create a `AsyncLog` model so that you can save the` message`. The general flow of work is as follows.

1. Create a Laravel application and prepare a model class table for message recording
2. Create a class that represents asynchronous processing and define the processing that you want to execute asynchronously as a method.
3. Call the process from `laravel console` and try to execute it

First, as a preliminary preparation, proceed with ** 1. Create a Laravel application and prepare a model class table for message recording **.
In addition, `laravel tests` is also introduced at this timing so that the PHPUnit file to be used later is generated. Please execute as follows.

```php
$ laravel new laravel_queues_example
$ cd laravel_queues_example
```

To set the database to postgresql open your “.env” file in the project folder and update the database information accordingly
    ```
    DB_CONNECTION=pgsql
    DB_HOST=<your_database_IP_address>
    DB_PORT=5432
    DB_DATABASE=<db_name>
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
    ```

Add the following code to the phpunit.xml file.

`phpunit.xml`

```php
<env name="APP_ENV" value="testing"/>
<env name="DB_CONNECTION" value="pgsql"/>
<env name="DB_DATABASE" value=":memory"/>
```

```php
$ php artisan make:model asyncLog -m
Model created successfully.
Created Migration: 2022_01_12_163033_create_async_logs_table

```

As a result so far, it is OK if the following model and schema files are created.

[app / models / asyncLog.php]

```php
class asyncLog extends Model
{
    use HasFactory;
}
```

[database/ migrations / create_async_logs_table.php]

```php
#omit
public function up()
    {
        Schema::create('async_logs', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->timestamps();
        });
    }
#omit
```

```
$ php artisan migrate
```
Make email template and mailable using `make:mail` artisan command with a mailable class

```
$ php artisan make:mail Message
```
[app/ Mail/ MessageMail.php]

```php
#omit
    public function build()
    {
    return $this->view('messages.view');
    }
```

## configure a queue

First lets use Command “queue:table” helps you to use the database driver for the queue.

```
$ php artisan queue:table
```
Run the “migrate” command once the migration files have been created. 

```
$ php artisan migrate
```

After the migration, the next step is updating the environment file to set a queue driver. You can open the `.env` file to set the value like below.

```
QUEUE_CONNECTION=database
```

Also, you need to check the `config/queue.php` file to ensure that the `QUEUE_CONNECTION` environment variable is used in it to set the default driver.

```
‘default’ => env(‘QUEUE_CONNECTION’, ‘sync’)
```

### Implement a queue job
Next, create a class that represents ** 2) asynchronous processing above, and proceed with ** defining the processing you want to execute asynchronously as a method **.

All of the queueable jobs for your application are stored in the `app/Jobs` directory by default. 
First, generate a job class with the `make:job` artisan command.

```php  
$ php artisan make:job asyncLog //it will create a skeleton for use in the “app/Jobs” folder
Job created successfully.
$ php artisan make:test asyncLogTest --u //generates a unit test file for asyncLog model
```

The job class file `app / jobs / asyncLog.php`  and its test file have been generated.
Job classes are very simple, normally containing only a `handle` method that is invoked when the job is processed by the queue.
Let's implement this as follows:

[app / jobs / asyncLog.php]

```php
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
        $message = new Message();
        Mail::to(‘test@test.com’)->send($message);
    }
}
```

I will explain some points.

First, the job class inherits from `ShouldQueue`.
`ShouldQueue` is a class in the same position as` Model` in the model, and the file is `app / jobs / asyncLog.php`.

The `SerializesModels ` trait that the job is using, Eloquent models and their loaded relationships will be gracefully serialized and unserialized when the job is processing.

Finally, write the process you want to execute in the job in the `handle()` method. The `handle` method is invoked when the job is processed by the queue.
Here, I am creating a job that takes a `mail` string as an argument and saves it in the database using the` AsyncLog` model.

### Put the job in the queue
Now, let's actually submit the job and execute it.

Once you have written your job class, you may dispatch it using the `dispatch` method on the job itself. The arguments passed to the `dispatch` method will be given to the job's constructor which you might use accordeing to the nature of your application which you may find convenient calling it from controller, route or mailer class.

```php
$message = new Message();
$this->dispatch($message);
```

Now let's check if the job has run.After Dispatching a job, you need to process this queue by using the following command

```php
$ php artisan queue:work
```

If you would like to specify that a job should not be immediately available for processing by a queue worker, you may use the [delay] (https://laravel.com/docs/8.x/queues "doc") method when dispatching the job.

For example, let's specify that a job should not be available for processing until 10 minutes after it has been dispatched:

```php
$message = new Message();
$this->dispatch($message)->delay((now)->addMinutes(10));
```

If you would like to dispatch a job immediately (synchronously), you may use the `dispatchSync` method.

## summary
-** Laravel has Queues as an asynchronous processing management library. It is used internally by other laravel's features. ** **
-** To define asynchronous processing, create a job class that inherits the base class `ShouldQueue` provided by Laravel Queues, and define the processing in the` handle()` method. ** **