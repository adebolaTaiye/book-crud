<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Book;
use Tests\TestCase;


class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_create_page_returns_a_successful_response(): void
    {
        $response = $this->get('/create');

        $response->assertStatus(200);
    }

    public function test_the_edit_page_returns_a_successful_response(): void
    {
        $book = Book::factory()->create();

        $response = $this->get("/book/{$book->id}");

        $response->assertStatus(200);
    }

    public function test_the_show_page_returns_a_successful_response(): void
    {
        $book = Book::factory()->create();

        $response = $this->get("/book/{$book->id}/show");

        $response->assertStatus(200);
    }


    public function test_that_book_resource_can_be_created(): void
    {
        $data = [
            'title' => 'Joy goes to school',
            'author' => 'James Jones',
            'description' => 'This is a book about a young girl named Joy discovering her life',
            'published_year' => '2002',
            'status' => 'borrowed'
        ];

        $response = $this->post('/store',$data);

        $response->assertSessionHas('message', 'record added Successfully');

        $this->assertDatabaseHas('books', [
            'title' => 'Joy goes to school',
            'author' => 'James Jones',
            'description' => 'This is a book about a young girl named Joy discovering her life',
            'published_year' => '2002',
            'status' => 'borrowed'
        ]);
    }

     public function test_the_book_resource_can_be_updated_successfully(): void
     {
        $book = Book::factory()->create();

        $updatedData = [
            'title' => 'Joy goes to school part 2',
            'author' => 'James Jones',
            'description' => 'This is a book about a young girl named Joy discovering her life',
            'published_year' => '2002',
            'status' => 'borrowed'
        ];

         $response = $this->patch("/book/{$book->id}",$updatedData);

         $response->assertSessionHas('message', 'record updated Successfully');

         $this->assertDatabaseHas('books', [
            'title' => 'Joy goes to school part 2',
            'author' => 'James Jones',
            'description' => 'This is a book about a young girl named Joy discovering her life',
            'published_year' => '2002',
            'status' => 'borrowed'
        ]);
     }

     public function test_the_book_resource_can_be_deleted_successfully(): void
     {
         $book = Book::factory()->create();

         $response = $this->delete("/book/{$book->id}");

         $response->assertSessionHas('message', 'record deleted Successfully');
     }


}
