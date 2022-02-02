<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // public function test_user_can_view_login_form()
    // {
    //     $response = $this->get('/login');
    //     $response->assertSuccessful();
    //     $response->assertViewIs('auth.login');
    // }

    // public function test_user_cannot_view_login_form_when_authenticated()
    // {
    //     $user = User::factory()->make();

    //     $response = $this->actingAs($user)->get('/login');
    //     $response->assertRedirect('/home');

    //     $repsonse1 = $this->get('/book');
    //     $repsonse1->assertSeeText('Book');
    // }

    // public function test_user_can_login_with_correct_creds()
    // {
    //     $user = User::factory()->make([
    //         'email' =>'admin@gmail.com',
    //         'password' => bcrypt('admin123'),
    //     ]);

    //     $credential = ['email'=>'admin@gmail.com','password'=>'admin123'];
        
    //     $response = $this->post('/login', $credential);
        
    //     // $response->assertRedirect('/home');

    //     $response->assertSessionHasNoErrors()
    //     ->assertStatus(302)
    //     ->assertRedirect('/home');

        
    // }
    // public function test_enable_to_create_a_book()
    // {
    //     $response = $this->post('/tasks', [
    //                 'title'=>'Laravel Book1',
    //                 'memo'=> 'Nice book1'
    //             ]); 
        
    //     $response
    //         // ->assertStatus(201);
    //         ->assertExactJson([
    //             'message' => "Book was successfully created",
    //         ]);
    // }

    // public $choices = ['rock','paper','scissors'];

    // -----------------------------------------
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
