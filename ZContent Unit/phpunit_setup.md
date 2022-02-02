# PHPUnit setup

## Goal
-** You can create an PHPUnit execution environment with the target application **
## Install gem for RSpec
Let's introduce PHPUnit to the project created by `laravel new`.

First, create a new project with `laravel new`.
```bash
# Advance preparation
$ mkdir -p ~ / workspace / dive-into-code / scaffold / sample
$ cd ~ / workspace / dive-into-code / scaffold / sample
$  sudo update-alternatives --set php /usr/bin/php8.1
$ laravel new sample 
$ cd sample
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

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/6d299d5aa96df016053bcfbe8a8ef459.png)] (https://diveintocode.gyazo.com/6d299d5aa96df016053bcfbe8a8ef459)

Laravel is built with testing in mind. In fact, support for testing with [`PHPUnit`] (https://laravel.com/docs/8.x/testing) is included out of the box and a `phpunit.xml` file is already set up for your application. The framework also ships with convenient helper methods that allow you to expressively test your applications.

By default, your application's tests directory contains two directories: `Feature` and `Unit`,  but custom and specific testing file can be generated with the use of `make:test` Artisan command wewould be to initialize and prepare the files required for PHPUnit.

```
$ php artisan make:test ExampleTest
```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/4f8027617e387f9c695672b415367506.gif)] (https://diveintocode.gyazo.com/4f8027617e387f9c695672b415367506)

By default, tests will be placed in the tests/Feature directory:
Now, execute the following command to create the skeleton and table of the application.

```
$ php artisan make:model Post --all
```
In the migration file created add table book's field as shown below

```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');                       
            $table->timestamps();
        });
    }
```
Migrate the changes to the databade

```
$ php artisan migrate
```

We also need to add $fillable property into Post model
```php
#omit
  class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body'
    ];
}
```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/18bdb218f4f14fb463400cb1ef17a330.gif)] (https://diveintocode.gyazo.com/18bdb218f4f14fb463400cb1ef17a330)

## How to execute the rspec command

To run your tests, execute the `vendor/bin/phpunit` or `php artisan test` command from your terminal.

I'll explain how to write the test code in the text that follows.
I want you to get an image of the test here, so let's run the automatically generated test file first.

```
$ php artisan test
```

The terminal should output something like this:  You don't need to know the details now.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/8399e6e7a073c38e5b7320a57af038f5.png)] (https://diveintocode.gyazo.com/8399e6e7a073c38e5b7320a57af038f5)

If WARNING appears when executing php artisan test, update the version of PHP,
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/6ef930b42ec029357c8908a4c1287901.gif)] (https://diveintocode.gyazo.com/6ef930b42ec029357c8908a4c1287901)

Please note that this text has been tested with the following versions: If you update the version of PHP and laravel it may have been fixed so that the warning is not displayed.
--PHP 8.1.1
--Laravel 8.0

If you specify the file name of the test code immediately after the rspec command, you can execute the test of the target file alone.
As an example, let's run the Request Spec file with the `php artisan test tests/Feature/PostTest.php` command.

You can see that the test cases listed in the file were run.
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/19bb01553f497ac557f7a3a1d28d34f8.png)] (https://diveintocode.gyazo.com/19bb01553f497ac557f7a3a1d28d34f8)

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/4257e3cce85124bc775e6898e50afe63.png)] (https://diveintocode.gyazo.com/4257e3cce85124bc775e6898e50afe63)

It is also possible to specify the test case in the file and execute it by specifying the method name immediately after the file name with `::method_name`.
There are some test cases described, but let's specify the first test case.

```
$ php artisan test --filter PostTest::test_example
```

I was able to run the test by specifying only one target test case.
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/b175b5ed788d576e235197d2ab5d32c5.png)] (https://diveintocode.gyazo.com/b175b5ed788d576e235197d2ab5d32c5)

The following text will explain how to actually write a test.

## summary
-** Laravel is built with testing in mind. In fact, support for testing with [`PHPUnit`] (https://laravel.com/docs/8.x/testing). ** **
-** You can execute the test cases described in the files under the tests directory with the `vendor/bin/phpunit` or `php artisan test` command. ** **
-** By specifying the file name or method name  of the test case immediately after the `vendor/bin/phpunit` or `php artisan test` command, you can execute the test with a single file or a single test case. ** **