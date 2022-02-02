
# How to write System Test

## Goal
-** Understand what you can do with System Test **
-** You will be able to write System Test **

## What is System Test?

`System Test` means a test to run and check a browser using PHPUnit.
It is also called an E2E (End to End) test or a system test that tests the entire system to check the input to output on the screen from end to end.

In addition to being able to instruct the operation in the browser, it is also characterized by being able to confirm the operation of JavaScript, which cannot be done by other tests.


## Write System Test

Create a `System Test` in the application you created last time.

Use the `php artisan make:test BookTest` command to automatically generate test code.
In addition, let's check the contents of the generated test code with the `cat` command.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/6c082ac32e7c0c7c3a9129aa196069d7.png)] (https://diveintocode.gyazo.com/6c082ac32e7c0c7c3a9129aa196069d7)


When you run the test with the `vendor/bin/phpunit tests/Unit/BookTest.php` command, the test result is displayed as pending, not successful or unsuccessful.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/d09a9041f5b028b34d00365fa637d491.png)] (https://diveintocode.gyazo.com/d09a9041f5b028b34d00365fa637d491)

Let's write a test in this code to check the display of the `Books` list page.

[test / Unit / BookTest.php]

```php
class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_enables_to_visit_the_index()
    {
        $repsonse = $this->get('/book');
        $repsonse->assertSeeText('Books');
    }

}
```

I will explain the above test case.

```php
$repsonse = $this->get('/book');
```
--Access the `Books` list page with a browser.

```php
$repsonse->assertSeeText('Books');
```

--Check if the text "Books" is present in the HTML of the displayed page.

Here we are using the `assertSeeText` assertion of PHPUnit Assertions [`PHPUnit Assertions`] (https://github.com/sebastianbergmann/phpunit-documentation-english/blob/master/src/assertions.rst "doc") to test if the HTML page contains text characters. ..
Other assertions are described in [List of `PHPUnit` assertions] (https://github.com/sebastianbergmann/phpunit-documentation-english/blob/master/src/assertions.rst" doc "), so they are required for test cases. Find and use the assertions.

When I ran the test, I got the result that the test was successful, saying, "As a result of checking one example, there are no cases that failed."

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/7781ff43f66eba1a4a9bad4ac0d833c7.png)] (https://diveintocode.gyazo.com/7781ff43f66eba1a4a9bad4ac0d833c7)

## Fail the test

Let's change the content to be checked from "Books" to "foo" and let the test fail on purpose.
You can see that `1 example, 1 failure` and one test failed at` tests / Unit / BookTest.php`.

The contents of the test failure are as follows.
```
Failure / Error: $repsonse->assertSeeText('foo');)
```
--`assertSeeText` is failing

```
expected to find text "foo" in "Books \ nTitle Memo \ n \ nNew Book"
```
--The confirmed HTML does not contain the string "foo"

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/f5722d2deb6db0f51da8d9bc67ff7147.png)] (https://diveintocode.gyazo.com/f5722d2deb6db0f51da8d9bc67ff7147)

If `System Test` fails, a browser screenshot will be created under the` tmp / screenshots` directory.
You can check the contents of the list screen displayed by the failed test by checking with the `open` command.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ba1f1427a6318731333fe3536988fd8e.png)] (https://diveintocode.gyazo.com/ba1f1427a6318731333fe3536988fd8e)

By failing the test in this way, the developer can notice when there is a change in the display content on the screen.

## Create test data and write tests

Before displaying the list screen, let's create test data with the previously defined `Laravel Factory`.

You can create test data with the code `Book::factory()->count(1)->create()`, but let's assign it to a local variable because we want to check the contents of the created data later.

[tests / Unit / BookTest.php]

```php
public function test_enables_to_visit_the_index()
    {
        $book = Book::factory()->count(1)->create();
        $book = Book::first();
        $repsonse = $this->get('/book');
        $repsonse->assertSeeText($book->title);
    }
```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/fe07ac9c39b909c7abee69cad5b0680d.png)] (https://diveintocode.gyazo.com/fe07ac9c39b909c7abee69cad5b0680d)

In this test code, the title information obtained by `book.title` from a local variable called` book` is set in the argument of the `have_text` matcher of` expect` and tested.

## Write a test to POST from a form

Let's write a test to create a `Book` with a` POST` request by entering a value in each field of the form on the `create` screen.

[tests / Unit / BookTest.php]

```php
public function test_enables_to_create_a_book()
    {
        $response = $this->postJson('/api/books', [
            'title'=>'Laravel Book',
            'memo'=> 'Nice book'
        ]); 

        $response
            ->assertStatus(201)
            ->assertExactJson([
                'message' => "Book was successfully created",
            ]);
    }
```

I will explain the above test case.

```php
'title'=>'Laravel Book'
```

--Enter the string "RubyBook" in the `Title` input field.

The syntax is as follows:

```php
'A'=>'B'
```

It means to enter the string "B" in the form corresponding to the label "A".


[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/046981d8e70d977d7f6761a9f2e59122.png)] (https://diveintocode.gyazo.com/046981d8e70d977d7f6761a9f2e59122)

As a result, the `POST` request runs the application's` BooksController # store` and redirects to the list screen after the `Book` is created.
You can determine if the test is successful by looking at the redirected page and seeing the flash message `Book was successfully created.`.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ca379bccea29dfdb16122caa96d5a386.png)] (https://diveintocode.gyazo.com/ca379bccea29dfdb16122caa96d5a386)

Two tests were run, as the test result above says `2 examples`.
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/8e13151f945f120d0e9ca1ac27faf362.png)] (https://diveintocode.gyazo.com/8e13151f945f120d0e9ca1ac27faf362)

You can see that only the test cases that correspond to the specified row have been executed.

## System Spec settings

`System Test` [`System Test`,"https://laravel.com/docs/5.8/testing",doc] For laravel application by default to run tests we use phpunit, that is automatically set the configuration environment as it is defined after generating a new project in `phptunit.xml` uses Google Chrome as your browser by default.Laravel also automatically configures the session and cache to the array driver while testing, meaning no session or cache data will be persisted while testing.

## summary
-** `System Test` allows you to launch a browser and test the entire function of the system, from inputting on the screen to displaying updated data. ** **
-** By changing the driver used in `System Test`, you can hide the browser and execute test cases at high speed. ** **
