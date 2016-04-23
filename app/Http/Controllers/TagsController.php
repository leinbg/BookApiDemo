<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helpers\Transformer\TagsTransformer;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

/**
 * Class TagsController
 *
 * @package App\Http\Controllers
 */
class TagsController extends ApiController
{

    /**
     * @var TagsTransformer
     */
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
        $limit = Input::get('limit') ?: 3;
        $tags = $this->getTags($bookId, $limit);

        return $this->responseSuccessWithPagination($tags, [
            'data' => $this->tagsTransformer->transformCollection($tags->all())
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
     * @param $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getTags($bookId, $limit)
    {
        return $bookId ? Book::findOrFail($bookId)->tags()->paginate($limit) : Tag::paginate($limit);
    }
}
