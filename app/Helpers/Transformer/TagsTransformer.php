<?php

namespace App\Helpers\Transformer;

/**
 * Class TagsTransformer
 *
 * @package App\Helpers\Transformer
 */
class TagsTransformer extends Transformer
{

    /**
     * @param object $tag book
     *
     * @return array
     */
    public function transform($tag)
    {
        if (!$tag) {
            return null;
        }

        return [
            'name' => $tag['name'],
        ];
    }
}