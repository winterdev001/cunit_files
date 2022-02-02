
# How to write Request Test

## Goal
-** Understand what you can do with Request Test **
-** You will be able to write Request Test **

## What is Request Test?
Request Spec is a test that sends a specific method such as GET or POST to the server as a request and confirms the contents of the returned response.
It is mainly used as a test of API that returns data such as JSON, not from the viewpoint of "what is included in the HTML element of the browser" like System Test.

JavaScript doesn't work because it doesn't start the browser, and no screenshot is taken when the test fails.
System Test tested requests such as POST by submitting what you entered in the form. However, Request Test allows you to explicitly state the HTTP method name.

## Write a Request Spec

Let's create a process that returns a value in JSON format to be checked by Request Spec.
First, create a controller.

```
$ php artisan make:controller StatusController
```

In addition to the controller, a Request Test file is automatically generated.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/dd7246781534b5eb5c743e5e5375b4da.png)] (https://diveintocode.gyazo.com/dd7246781534b5eb5c743e5e5375b4da)


Please add to the following file so that the value is returned in JSON.

[routes / api.php]

```
Route::resource('status',StatusController::class);
```

[app / Http / Controllers /  StatusController.php]

```
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'ok',
        ]);
    }
}
```

If you run `php artisan serve` with the implementation so far and access` localhost: 8000 / status` with a browser, you can see the JSON value as below.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ca646abacac505ad93107f4b71f890a0.png)] (https://diveintocode.gyazo.com/ca646abacac505ad93107f4b71f890a0)

Create a Request Test to confirm this.

[test / Unit / StatusTest.php]

```
public function test_statuses()
{
    $response = $this->get('api/status');
    $response
        ->assertStatus(200)
        ->assertExactJson([
            'status' => "ok",
        ]);
}
```

In this test, the following confirmations are made.
--Send the GET method to `api/status` with` get "ap/status" `.
--You can get the response object returned by the controller with `response`.
--Make sure that the status code is 200 (successful request) and that the content type is what you intended.
--After that, make sure that the response contains the content `{status:" ok "}`.

Let's run the test with the following command.

`` ```
$ php artisan test tests/Unit/StatusTest.php
`` ```

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ad5f927480b3d822d9f13d8ec04826b1.png)] (https://diveintocode.gyazo.com/ad5f927480b3d822d9f13d8ec04826b1)


## summary
-** Request Test is mainly used to confirm the process of returning JSON format data. ** **
-** In Request Test, check and test the status code of the response object and the JSON value included. ** **