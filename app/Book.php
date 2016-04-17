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
}
