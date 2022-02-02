# Write a test separately

## Goal
-** Understand the differences between Laravel tests and write tests **

Let's organize the uses of PHPUnit that we have learned in the textbooks so far.

## Model Test

With Model Test or Feature Test, you can check the validation contents defined in the model class and verify the return value that is the execution result of the described method.
When checking a method that has particularly complicated logic, you can check by writing a combination of arguments and return value.

You can't see what you're finally seeing in your browser for the features you've tested.
You need to check the contents of the browser with System Test.

## System Unit Test

System Unit Test uses PHPUnit to specify the behavior on the browser and check the displayed contents.
Since the entire system can be checked, which is called the E2E test, the test range is wide and it is easy to increase the test coverage.

If there is a small bug, it is difficult to isolate the cause, so let's make it possible to detect complicated processing with Model Test.
Also, for the function that returns the response as API instead of HTML, it is necessary to describe Request Test.

## Request Test

With Request Test, you can send any method such as GET or POST as a request and check the response content as a result.
It is mainly used to check the function created as an API that returns a value in JSON format instead of HTML.

Even HTML-formatted applications may be used when the specifications have not yet been decided and the screen configuration changes frequently.
In this case, even if you specify the movement and display contents on the browser with System Test, the specifications may be changed and rewritten later.
In that respect, once Request Test is described, GET and POST methods can be sent as a request regardless of the screen configuration, and the minimum confirmation that the response is normal can be performed.

## summary
-** If the function to be tested is HTML, describe the test with System Unit Test, and if it is API, describe the test with Request Test. ** **
-** For functions with complicated logic or multiple patterns, it is advisable to write a test for verification in Feature Test. ** **