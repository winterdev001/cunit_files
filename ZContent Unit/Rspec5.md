
# Use test code

## Goal
-** Understand how to use System Unit Test and Feature Test **

## Unit Test

System Unit Test uses PHPUnit to specify the behavior on the browser and check the displayed contents.
Since the entire system can be checked, which is called the E2E test, the test range is wide and it is easy to increase the test coverage.

If there is a small bug, it is difficult to isolate the cause, so let's make it possible to detect complicated processing with Model Test.
Also, for the function that returns the response as API instead of HTML, it is necessary to describe Request Test.

[tests / Unit / BookTest.php]

```php
public function test_enables_to_visit_the_index()
{
    $repsonse1 = $this->get('/book');
    $repsonse1->assertSeeText('Book');

}

public function test_enables_to_create_a_book ()
{
  $response = $this->post('/book', [
                        'title'=>'Laravel Book',
                        'memo'=> 'Nice book'
                    ]); 
            
  $response
      ->assertExactJson([
          'message' => "Book was successfully created",
      ]);
    
}
```

## Feature Testing

With Model Test or Feature Test, you can check the validation contents defined in the model class and verify the return value that is the execution result of the described method.
When checking a method that has particularly complicated logic, you can check by writing a combination of arguments and return value.

You can't see what you're finally seeing in your browser for the features you've tested.
You need to check the contents of the browser with System Test.

By including `Illuminate\Foundation\Testing\RefreshDatabase` and calling `RefreshDatabase` method in you test file, it reset your database after each test so that data from a previous test does not interfere with subsequent tests as defined in laravel docs [ResettingTheDatabaseAfterEachTest] (https://laravel.com/docs/5.6/database-testing#resetting-the-database-after-each-test "doc").

[tests / Feature / BookTest.php]

```php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_enables_to_login_and_visit_the_index()
    {
      $user = User::factory()->make([
                'email' =>'admin@gmail.com',
                'password' => bcrypt('admin123'),
            ]);

        $credential = ['email'=>'admin@gmail.com','password'=>'admin123'];
        
        $response = $this->post('/login', $credential);    

        $response->assertSessionHasNoErrors()
        ->assertStatus(302)
        ->assertRedirect('/home');

        $repsonse1 = $this->get('/book');
        $repsonse1->assertSeeText('Book');

    }

    public function test_enables_to_login_and_create_a_book ()
    {
      $user = User::factory()->make([
                'email' =>'admin@gmail.com',
                'password' => bcrypt('admin123'),
            ]);

        $credential = ['email'=>'admin@gmail.com','password'=>'admin123'];
        
        $response = $this->post('/login', $credential);    

        $response->assertSessionHasNoErrors()
        ->assertStatus(302)
        ->assertRedirect('/home');

        $response = $this->post('/book', [
                        'title'=>'Laravel Book',
                        'memo'=> 'Nice book'
                    ]); 
            
        $response
            ->assertExactJson([
                'message' => "Book was successfully created",
            ]);
    }
}
```


## shared_example

`shared_example` may be used to describe all the behaviors of the` expect` to be confirmed when they are common.

As an example, let's say you have a method to check the logic of rock-paper-scissors.
This method defines your own hand as the first argument and the opponent's hand as the second argument, and by passing any of goo, choki, and par, it is assumed that you win or lose or draw.

The test code is as follows.

```php
class SharedTest extends TestCase
{ 
  public function janken($user,$opponent){
        if($user === 'rock' && $opponent === "rock"){
            return $response = 'draw';
        } 
        elseif ($user === 'rock' && $opponent === "scissors"){
            return $response = 'win';
        }
        elseif ($user === 'rock' && $opponent === "paper") {
            return $response = 'lose';
        }
        elseif ($user === 'rock' && $opponent === 0) {
            return $response = 'invalid';
        }
        elseif ($user === 'scissors' && $opponent === "paper") {
            return $response = 'win';
        }
    }

    public function test_user_gives_rock_and_opponent_gives_rock_its_draw()
    {
        $response = $this->janken('rock','rock');
        $this->assertTrue($response === 'draw');
    }

    public function test_user_gives_rock_and_opponent_gives_scissors_user_win()
    {
        $response = $this->janken('rock','scissors');
        $this->assertTrue($response === 'win');
    }

    public function test_user_gives_rock_and_opponent_gives_paper_user_loss()
    {
        $response = $this->janken('rock','paper');
        $this->assertTrue($response === 'lose');
    }

    public function test_user_gives_rock_and_opponent_gives_invalid_result_is_invalid()
    {
        $response = $this->janken('rock',0);
        $this->assertTrue($response === 'invalid');
    }
    public function test_user_gives_scissors_and_opponent_gives_paper_user_win()
    {
        $response = $this->janken('scissors','paper');
        $this->assertTrue($response === 'win');
    }
}
```

## shared_context

`shared_context` may be used to concisely specify the test case conditions to check.

As an example, suppose you have a method that changes the result of a greeting depending on the nationality you specify.
Suppose this method runs as an instance method of a `Person` object and returns different greetings depending on the nationality of the` Person`.

```php
class SharedTest extends TestCase
{
  public function greeting($nationality)
    {
        if($nationality === 'japan'){
            return $response = 'Hello';
        }
        elseif($nationality === 'united_states'){
            return $response = 'Hello';
        }
        elseif($nationality === 'germany'){
            return $response = 'Guten Tag';
        }
    }

    public function test_person_from_japan(){
        $person = User::factory()->make([
            'nationality'=>'japan'
        ]);

        $response = $this->greeting($person->nationality);
        $this->assertTrue($response === 'Hello');

    }

    public function test_person_from_united_states(){
        $person = User::factory()->make([
            'nationality'=>'united_states'
        ]);

        $response = $this->greeting($person->nationality);
        $this->assertTrue($response === 'Hello');

    }

    public function test_person_from_germany(){
        $person = User::factory()->make([
            'nationality'=>'germany'
        ]);

        $response = $this->greeting($person->nationality);
        $this->assertTrue($response === 'Guten Tag');

    }
 }

```

## summary
-** In PHPUnit, you can collectively define the contents to be executed whether using Systen Unit test or Feature test. ** **
-** In PHPUnit, the confirmation contents can be called by shared_example, and the test data conditions can be called by common by shared_context. ** **
-** It may be possible to make redundant descriptions common and concise with these syntaxes, but be aware that it may be complicated. ** **