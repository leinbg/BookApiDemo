<?php

namespace App\Helpers\Filter;

/**
 * Class BookFilters
 *
 * @package app\Helpers\Filter
 */
class BookFilters extends QueryFilter
{

    /**
     * @param string $order
     *
     * @return mixed
     */
    public function popular($order = 'desc')
    {
        return $this->builder->orderBy('rate', $order);
    }

    /**
     * @param $lang
     *
     * @return mixed
     */
    public function lang($lang)
    {
        return $this->builder->where('language', $lang);
    }

    /**
     * @param $price
     *
     * @return mixed
     */
    public function maxprice($price)
    {
        return $this->builder->where('price', '<', $price);
    }

    /**
     * @param $price
     *
     * @return mixed
     */
    public function minprice($price)
    {
        return $this->builder->where('price', '>', $price);
    }
}