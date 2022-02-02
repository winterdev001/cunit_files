#Why do you need test code?

## Goal
-** Understand what a test code is **
-** Understand the need and purpose of test code **

## What is a test code?
First of all, what is the test code?

A test code is a program that compares the expected value with respect to the input value and the result, and confirms the difference.

For example, the code below confirms that "as a result of executing the` actingAs($user) `method,` Auth::check()` is not nil "as an expected value.
You don't have to understand the details of the code right now.

```php
$this->actingAs($user)
->assertTrue(Auth::check());
```
If `Auth::check()` is not` nil`, the test is successful.
If `Auth::check()` is` nil`, the test will fail and will be displayed in the test code execution results.

## Necessity and purpose of test code
What would happen if there were no such test code?

Adding a function to an application affects some code such as the target screen, the added file, and its caller.
Without test code, we cannot guarantee that there will be no defects without manually checking the behavior of the application each time a function is added.
As your application grows in size, the cost of verification work increases and the chances of oversight increase.
If you overlook a bug, you may create inconsistent data in a production application or even stop the service in the worst case.

Also, consider a complex implementation that is complicated to process, or you want to improve code that is difficult to maintain.
Without the test code, it would be very difficult to see which other processes would be affected by the refurbishment work and whether the affected processes were working without problems.

As a result, if you think that you will not touch the existing implementation that is working, you will not be able to add or modify the functions of the source code. In addition, it becomes a black box where you don't know why your application code is working, making maintenance impossible.

It is difficult to maintain a product as a service if it is no longer possible to actively add functions or improve the internal structure.

You can prevent these problems by writing a test code.
It is difficult to test all the processes of the implementation, but it is also useful to prioritize the test code such as important processes and parts affected by other code.

By successfully implementing the test code, you can add features and improve internals, giving the developer control over the application.
Therefore, it is common sense at the development site to write the test code together with the implementation.

## summary
-** The test code is a program for comparing the expected value and the result for the input value and confirming the difference. ** **
-** Without the test code, it is difficult to check the defects and overlook them, or to add or repair functions. ** **
-** Test code allows developers to actively add or modify features and control their applications. ** **