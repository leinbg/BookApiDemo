<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @package App
 */
class Book extends Model
{
    protected $fillable = ['title', 'author', 'content', 'rate'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
