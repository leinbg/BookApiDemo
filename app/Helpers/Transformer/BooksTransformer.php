<?php

namespace App\Helpers\Transformer;

/**
 * Class BooksTransformer
 *
 * @package App\Helpers\Transformer
 */
class BooksTransformer extends Transformer
{

    /**
     * @param object $book book
     *
     * @return array
     */
    public function transform($book)
    {
        if (!$book) {
            return null;
        }

        return [
            'title' => $book['title'],
            'author' => $book['author'],
            'rate' => $book['rate'],
            'lang' => $book['language'],
            'price' => $book['price'],
        ];
    }
}