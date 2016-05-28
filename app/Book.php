<?php

namespace App;

use App\Helpers\Filter\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @package App
 */
class Book extends Model
{
    protected $fillable = ['title', 'author', 'content', 'rate'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param Builder     $query
     * @param QueryFilter $filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply($query);
    }
}
