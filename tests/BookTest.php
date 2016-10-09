<?php

use App\Book;

/**
 * Class BookTest
 */
class BookTest extends ApiTest
{
    use \tests\helpers\Factory;

    public function setUp()
    {
        parent::setUp();

        $this->make(Book::class, 3);
    }

    /** @test */
    public function it_fetches_books()
    {
        $this->getJson('/api/v1/books');
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_book()
    {
        $book = $this->getJson('/api/v1/books/1')->data;
        $this->assertResponseOk();
        $this->assertObjectHasAttributes($book, ['title', 'author', 'price', 'lang']);
        $this->assertObjectNotHasAttribute('content', $book);
    }

    /** @test */
    public function it_fetches_books_cheaper_than_100()
    {
        $books = $this->getJson('/api/v1/books?maxPrice=100');
        foreach ($books->data as $book) {
            $this->assertLessThan(100, $book->price);
        }
    }

    /** @test */
    public function it_fetches_books_more_expensive_than_150()
    {
        $books = $this->getJson('/api/v1/books?minPrice=150');
        foreach ($books->data as $book) {
            $this->assertGreaterThan(150, $book->price);
        }
    }

    /** @test */
    public function it_gets_404_if_book_is_not_found()
    {
        $this->getJson('/api/v1/books/aaa');
        $this->assertResponseStatus(404);
    }

    /**
     * @return array
     */
    public function getStub()
    {
        return [
            'title' => $this->fake->sentence,
            'content' => $this->fake->paragraph,
            'author' => $this->fake->name,
            'rate' => $this->fake->randomDigitNotNull,
            'language' => $this->fake->randomElement(['english', 'german', 'chinese']),
            'price' => $this->fake->randomFloat(2, 0, 300),
        ];
    }
}
