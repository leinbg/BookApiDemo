<?php
/**
 * Class BookTest
 */
class BookTest extends ApiTest
{
    /** @test */
    public function it_fetches_books()
    {
        $this->makeBooks();
        $this->getJson('/api/v1/books');
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_book()
    {
        $this->makeBooks();
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
     * @param array $bookFields
     */
    protected function makeBooks($bookFields = [])
    {
        $books = array_merge([
            'title' => $this->fake->sentence,
            'content' => $this->fake->paragraph,
            'author' => $this->fake->name,
            'rate' => $this->fake->randomDigitNotNull,
        ], $bookFields);

        \App\Book::create($books);
    }

    /**
     * @param $url
     *
     * @return object
     */
    protected function getJson($url)
    {
        return json_decode($this->call('GET', $url)->getContent());
    }
}
