<?php

namespace Tests\Unit;

// use Tests\TestCase;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function test_user_duplication(){
        // $response = $this->get('/login');
        // $response->assertStatus(200);
        $user1 = User::make([
            'name'=> 'John',
            'email'=> 'john@gmail.com'
        ]);

        $user2 = User::make([
            'name'=> 'Dan',
            'email'=> 'Dan@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    // public function test_delete_user()
    // {
    //     $user = User::factory()->count(1)->make();

    //     $user = User::first();

    //     if($user){
    //         $user->delete();
    //     }

    //     $this->assertTrue(true);
    // }

    // public function test_database()
    // {
    //     $this->assertDatabaseMissing('users',[
    //         'name'=>'Tom'
    //     ]);
    // }

    // public function test_seeders_work()
    // {
    //     $this->seed(); //seed all seeders in the seeders folder 
    //     //equivalent to php artisan db:seed
    // }

    // public function check_user_duplication(){
    //     $user1 = User::make([
    //         'name'=> 'John',
    //         'email'=> 'john@gmail.com'
    //     ]);

    //     $user2 = User::make([
    //         'name'=> 'Dan',
    //         'email'=> 'Dan@gmail.com'
    //     ]);

    //     $this->assertTrue($user1->name != $user2->name);
    // }
}
