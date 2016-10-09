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
    public function it_fetches_english_books()
    {
        $books = $this->getJson('/api/v1/books?lang=english');
        foreach ($books->data as $book) {
            $this->assertEquals('english', $book->lang);
        }
    }

    /** @test */
    public function it_fetch_books_sort_by_rate_desc()
    {
        $books = $this->getJson('/api/v1/books?popular');
        $book1 = $books->data[0];
        $book2 = $books->data[1];
        $book3 = $books->data[2];

        // rate1 >= rate2 >= rate3
        $this->assertGreaterThanOrEqual($book2->rate, $book1->rate);
        $this->assertGreaterThanOrEqual($book3->rate, $book2->rate);
    }

    /** @test */
    public function it_fetch_books_sort_by_rate_asc()
    {
        $books = $this->getJson('/api/v1/books?popular=asc');
        $book1 = $books->data[0];
        $book2 = $books->data[1];
        $book3 = $books->data[2];

        // rate1 <= rate2 <= rate3
        $this->assertLessThanOrEqual($book2->rate, $book1->rate);
        $this->assertLessThanOrEqual($book3->rate, $book2->rate);
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
