# To create test data

## Goal

-**Laravel factory will be available**.

## Preparation

Before we learn to create test data, let's create a new project for creating test code in our local environment.
In the following `mkdir` command, multiple commands will be executed together separated by semicolons. In this case, we created a directory and moved it.

```
$ mkdir -p˜ / Workspace / dive-into-code / phpspec; cd $ _
$ laravel new system_spec --8
$ cd system_spec
```

## What is the Laravel Factory?

The [Laravel Factory](https://github.com/coderello/laravel-populated-factory "doc") is a facility for creating test data.

When testing, you may need some data to validate your test cases.
In this case, you can also use the Model and ActiveRecord methods to create test data.
However, Laravel provides the ability to define all the test data to be used and call it when the test is run.

## Introducing the Laravel Factory

To create the factory data, we will generate a factory file in `database / factories / name_of_factory.php`.

## Create the code to test

Use the following command to create the code to test.

```
$php artisan make:model book --all
``` 

$ php artisan make:model book --all
In the created migration file, add the table book fields as shown below

``` php
#omit
Public function up ()
    {
        Schema::create( 'books',function(Blueprint $ table) {
            $ table-> id ();
            $ table-> string ( 'title');
            $ table-> text ( 'memo');
            $ table-> timestamps ();
        });
    }
 #omit
```
Migrate changes to the database

```
$php artisan artisan
```

We also need to add the $fillable property to the Book model
``` php
#omit
class book extends model
{
    HasFactory;
    / **
     *Attributes that can be bulk assigned
     *
     * @ var array
     * /
    Protected $ fillable = [
        'Title',
        'Memo'
    ];
}
````

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/47ccda07972e1c30ee00492d54da6712.png)](https://diveintocode.gyazo.com/47ccda)(07972e1c30ee00492d54da6712)

To create a new factory file for code that has already been created, run the following command.

```
$ php artisan makefactory BookFactory --model = Book
```

## Define the laravel factory

Next, define the `laravelfactory` in a factory file.
In the file, write a block `[]` after the columns as shown below, and write the data you want to assign to the block.

[database/factories/BookFactory.php]

```php
#omit
  $ factory-> define(App\Book::class,function(Faker $faker) {
      Back [
          'title' => 'LaravelBook',
          'notes' => 'good',
      ];
  });
```

You can check the behavior of the described factory from the `laravel console`.
Create the database and tables, then run the migration.

```
$ php artisan migratefresh
$ php artisan tinker
$ Book::factory()->count(1)->create()
```

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/a3f3a28eb8e737c05d9e7c5acb14bde9.png)](https://diveintocode.gyazo.com/a3f3a28) eb8e737c05d9e7c5acb14bde9)

## Create association-related definition files

Create an association-related model and define the corresponding factory.

[database/factories/variation.php]

```php
public function definition()
{
    Return [
        'book_id' => Book :: factory (),
        'title' => $ this-> faker-> title (), 
        'memo' => $ this-> faker-> memo (), 
    ];
}
```

The above code yields the following results
1. Creates a `book` factory when you run this factory
2. Set the ID of the `book` as `book_id` and create an ` Association`.

[![Image from Gyazo](https://t.gyazo.com/teams/diveintocode/81a2b24e3c40aaa7e33a59d1c4205635.png)](https://diveintocode.gyazo.com/81a2b24e) 3c40aaa7e33a59d1c4205635)

The following instructions work the same way as the definition by `relation book`.

[databese /factory/variation.php].

```php
#omit
Public function definition ()
{
    Return [
        'book_id' => Book :: factory (),
        'title' => $ this-> faker-> title (),
        'memo' => $ this-> faker-> memo (), 
    ];
}
````

If you have more models and more associations, instead of associating the above factory definition, you can do the following

[app/models/Book.php]

```php
Use the App \ Models \ Post;
Use App \ Models \ User;

$ user = User :: factory ()
            -> has (Book :: factory ()-> count (1))
            -> create ();
````

[spec/factory/books.php].

```php
Public function definition ()
{{
    Return [
        'title' => $ this-> faker-> title (), and
        'memo' => $ this-> faker-> memo (),.
    ];
}
```

1. Create only a `book` without running `association`.

```
$ php artisan tinkerer
$ Book::factory(->count(1->create()))
```

2. Run `association` to create `book` and `variation

``` php
Return [
        'book_id' => Book::factory(),
        'title' => $ this-> faker-> title(),
        'memo' => $ this-> faker-> memo(),
    ];
```.

[! [image from Gyazo](https://t.gyazo.com/teams/diveintocode/057689f8eea7d1f5eb5893692ca90944.png)](https://diveintocode.gyazo.com/057689f8) (eea7d1f5eb5893692ca90944)


[! [Images from Gyazo](https://t.gyazo.com/teams/diveintocode/5e06c23b2e8d2cbbe5bbbf1ef9c3a331.png)](https://diveintocode.gyazo.com/5e06c23b) (2e8d2cbbe5bbbf1ef9c3a)


## Summary
-** If you are using laravel to create test code, `laravel factory` is commonly used to define, test and seed your data. ** **


Translated with www.DeepL.com/Translator (free version)