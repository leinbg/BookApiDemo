<?php

namespace App\Helpers\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class QueryFilter
 *
 * @package app\Helpers\Filter
 */
abstract class QueryFilter
{
    protected $request;

    protected $builder;

    /**
     * QueryFilter constructor.
     *
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $filterName => $value) {
            if (method_exists($this, $filterName)) {
                call_user_func_array([$this, $filterName], array_filter([$value]));
            }
        }
        return $this->builder;
    }
    
    /**
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }
}