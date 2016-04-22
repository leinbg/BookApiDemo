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
     * @return string
     */
    protected function getJson($url)
    {
        return json_encode($this->call('GET', $url)->getContent());
    }
}
