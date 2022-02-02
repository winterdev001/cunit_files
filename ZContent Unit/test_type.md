#Test type

## Goal
-** Understand the outline of various tests provided by Laravel **

## What is PHPUnit?

Laravel is built with testing in mind. In fact, support for testing with [`PHPUnit`] (https://laravel.com/docs/8.x/testing) is included out of the box and a `phpunit.xml` file is already set up for your application. The framework also ships with convenient helper methods that allow you to expressively test your applications.

By default, your application's tests directory contains two directories: `Feature` and `Unit`,  but custom and specific testing file can be generated with the use of `make:test` Artisan command wewould be to initialize and prepare the files required for PHPUnit.

## System Unit Test

Unit tests are tests that focus on a very small, isolated portion of your code. In fact, most unit tests probably focus on a single method. Tests within your `Unit` test directory do not boot your Laravel application and therefore are unable to access your application's database or other framework services

It is a test that you can start the browser and check the entire function from updating the database to displaying the screen.
This is a standard E2E test for apps that display the screen as HTML.
The E2E test, also called the End to End test, is a test that confirms a series of movements of the system functions from end to end and from start to finish.

When sending a request such as POST, it is necessary to enter each item of the form on the screen and enter the code of the instruction to press the submit button each time.
On the other hand, Request / HTTP Test, which will be described later, allows you to write a test by directly sending a request with arbitrary content without sandwiching the screen.


## Request / HTTP Test

Also know as HTTP Test in Laravel is a test that allows you to intentionally send a request and check the content of the response from the server.
It's a standard test for apps that send query results as an API, that is, in JSON format instead of HTML.
Not only GET but also any request such as POST, PUT, DELETE, etc. can be explicitly tested.

The get method makes a GET request into the application, while the assertStatus method asserts that the returned response should have the given HTTP status code. In addition to this simple assertion, Laravel also contains a variety of assertions for inspecting the response headers, content, JSON structure, and more.

## Model / Feature Test

Feature tests may test a larger portion of your code, including how several objects interact with each other or even a full HTTP request to a JSON endpoint. Generally, most of your tests should be feature tests. These types of tests provide the most confidence that your system as a whole is functioning as intended.

This kind of Test check whether the result is correct by passing test data as an argument for the method defined in the model or any other functions in your system.
You can perform tests focused on checking the execution results of processing logic, such as complicated conditional branches.

Even if the model does not have a defined method, the Model Test is often used to test the validation confirmation that has been set.
Since the display collapse of the screen of the target function cannot be confirmed, use System Unit Test if you want to check the display of the browser as well.

## Testing for individual Laravel features such as Mail and Queues

Dedicated tests are provided for testing certain processes, such as sending emails or running jobs on a regular basis.
We will discuss these details in other texts.

## summary
-** From Laravel development sites, the use of a test framework called PHPUnit. ** **
-** System Unit Tests are tests that focus on a very small, isolated portion of your code. ** **
-** Request/ HTTP Test allows you to check the server's response to any request. ** **
-** With Model/ Feature Test, you can efficiently check the processing results and validation of model methods or any other larger portion of your code. ** **