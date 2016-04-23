<?php
/**
 * Class BookTest
 */
class BookTest extends ApiTest
{
    use \tests\helpers\Factory;

    /** @test */
    public function it_fetches_books()
    {
        $this->make(\App\Book::class);
        $this->getJson('/api/v1/books');
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_book()
    {
        $this->make(\App\Book::class);
        $book = $this->getJson('/api/v1/books/1')->data;
        $this->assertResponseOk();
        $this->assertObjectHasAttributes($book, ['title', 'author']);
        $this->assertObjectNotHasAttribute('content', $book);
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
        ];
    }
}
