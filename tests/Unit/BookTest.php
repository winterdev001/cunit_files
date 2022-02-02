<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Book;

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
        $repsonse->assertSeeText('foo');
    }

    // public function test_enables_to_visit_the_index()
    // {
    //     $book = Book::factory()->count(1)->create();
    //     $book = Book::first();
    //     $repsonse = $this->get('/book');
    //     $repsonse->assertSeeText($book->title);
    // }

    // public function test_enables_to_create_a_book()
    // {
    //     $response = $this->postJson('/api/books', [
    //         'title'=>'Laravel Book',
    //         'memo'=> 'Nice book'
    //     ]); 

    //     $response
    //         ->assertStatus(201)
    //         ->assertExactJson([
    //             'message' => "Book was successfully created",
    //         ]);
    // }

    // public function test_statuses()
    // {
    //     $response = $this->get('api/books');
    //     $response
    //         ->assertStatus(200)
    //         ->assertExactJson([
    //             'status' => "ok",
    //         ]);
    // }
}
