<?php

namespace App\Helpers\Transformer;

/**
 * Class Transformer
 *
 * @package App\Helpers\Transformer
 */
abstract class Transformer
{

    /**
     * @param array $items items to transform
     *
     * @return mixed
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @param object $item item
     *
     * @return mixed
     */
    public abstract function transform($item);
}