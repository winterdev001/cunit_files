
# To create test data

## Goal
-**Laravel Factories will be available**

## Advance preparation
Before learning to create test data, let's create a new project to create test code in the local environment.
In the `mkdir` command below, multiple commands are executed together, separated by a semicolon. This time I created a directory and moved to it.

```
$ mkdir -p ~ / workspace / dive-into-code / phpspec; cd $ _
$ laravel new system_spec --8
$ cd system_spec
```

## What is Laravel Factory?

[`Laravel Factory`](<https://github.com/coderello/laravel-populated-factory> "doc") is a feature for creating test data.

When testing, you may need data to validate your test cases.
In this case, you can also create test data using the model and ActiveRecord methods.
However, Laravel has the ability to define all the test data you want to use and call it up when you run the test.

## Introduce Laravel Factory

Generate the factory file inside `database/factories/name_of_factory.php` for creating the factories data.

## Create code to test

Create the code to be tested with the following command.

```
$ php artisan make:model book --all
```
In the migration file created add table book's field as shown below

```php
#omit
public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('memo');                       
            $table->timestamps();
        });
    }
```
Migrate the changes to the databade

```
$ php artisan migrate
```

We also need to add $fillable property into Book model
```php
#omit
  class Book extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'memo'
    ];
}
```

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/47ccda07972e1c30ee00492d54da6712.png)](https://diveintocode.gyazo.com/47ccda07972e1c30ee00492d54da6712)

To create a new factory file for the code that has already been created, execute the following command.

```
$ php artisan make:factory BookFactory --model=Book
```

## Define laravel factory

Next, define `laravel factory` in the factory file.
In the file, write the block `[]` after the column as shown below, and write the data you want to assign in the block.

[database / factories / BooksFactory.php]

```php
#omit
  $factory->define(App\Book::class, function (Faker $faker) {
      return [
          'title' => 'LaravelBook',
          'memo' => 'Good',
      ];
  });
```

You can check the operation of the described factory from `laravel console`.
Create the database and tables, then run the migration.

```
$ php artisan migrate:fresh
$ php artisan tinker
$ Book::factory()->count(1)->create()
```

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/a3f3a28eb8e737c05d9e7c5acb14bde9.png)](https://diveintocode.gyazo.com/a3f3a28eb8e737c05d9e7c5acb14bde9)

## Write a related definition file

Create an association-related model and define the corresponding factory.

[database / factories / variation.php]

```php
#omit
public function definition()
{
    return [
        'book_id' => Book::factory(),
        'title' => $this->faker->title(),
        'memo' => $this->faker->memo(),
    ];
}
```

The above code gives the following result:
1. Create a `book` factory when running this factory
2. Set the ID of `book` as` book_id` and create `Association`

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/81a2b24e3c40aaa7e33a59d1c4205635.png)](https://diveintocode.gyazo.com/81a2b24e3c40aaa7e33a59d1c4205635)

The following description works in the same way as the definition by `relation book`.

[databese / factories / variation.php]

```php
public function definition()
{
    return [
        'book_id' => Book::factory(),
        'title' => $this->faker->title(),
        'memo' => $this->faker->memo(),
    ];
}
```

If you have more models and more associations, instead of making the factory definition above relevant do as follows

[app / models / Book.php]

```php
use App\Models\Post;
use App\Models\User;

$user = User::factory()
            ->has(Book::factory()->count(1))
            ->create();
```

[spec / factories / books.php]

```php
#omit
public function definition()
{
    return [
        'title' => $this->faker->title(),
        'memo' => $this->faker->memo(),
    ];
}
```

1. Create only `book` without executing the `association`

```
$ php artisan tinker
$ Book::factory()->count(1)->create()
```

2. Execute the association to create` book` and `variation`

```php
return [
        'book_id' => Book::factory(),
        'title' => $this->faker->title(),
        'memo' => $this->faker->memo(),
    ];
```

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/057689f8eea7d1f5eb5893692ca90944.png)](https://diveintocode.gyazo.com/057689f8eea7d1f5eb5893692ca90944)

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/5e06c23b2e8d2cbbe5bbbf1ef9c3a331.png)](https://diveintocode.gyazo.com/5e06c23b2e8d2cbbe5bbbf1ef9c3a)

## summary

-**When creating test code with laravel , `laravel factory` is common, and it is possible to define, test and seed data.**