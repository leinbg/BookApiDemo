<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helpers\Transformer\TagsTransformer;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class TagsController
 *
 * @package App\Http\Controllers
 */
class TagsController extends ApiController
{
    protected $tagsTransformer;

    /**
     * TagsController constructor.
     *
     * @param TagsTransformer $transformer
     */
    public function __construct(TagsTransformer $transformer)
    {
        $this->tagsTransformer = $transformer;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param string $bookId
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bookId = null)
    {
        $tags = $this->getTags($bookId);

        return $this->responseSuccess([
            'data' => $this->tagsTransformer->transformCollection($tags->toArray())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        $tag = $this->tagsTransformer->transform($tag);

        if (!$tag) {
            return $this->responseError('tag is not found');
        }

        return $this->responseSuccess([
            'data' => $tag
        ]);
    }

    /**
     * @param $bookId
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getTags($bookId)
    {
        return $bookId ? Book::findOrFail($bookId)->tags : Tag::all();
    }
}
