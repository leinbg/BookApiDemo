<?php

namespace App\Http\Controllers;

use App\Book;
use App\Helpers\Transformer\BooksTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

/**
 * Class BooksController
 *
 * @package App\Http\Controllers
 */
class BooksController extends ApiController
{
    protected $booksTransformer;

    /**
     * BooksController constructor.
     *
     * @param BooksTransformer $transformer transformer
     */
    public function __construct(BooksTransformer $transformer)
    {
        $this->booksTransformer = $transformer;

        //$this->middleware('auth.basic', ['only' => 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = Input::get('limit') ?: 3;

        $books = (new Book)->newQuery();

        if ($request->exists('popular')) {
            $books->orderby('rate', 'desc');
        }

        if ($request->has('lang')) {
            $books->where('language', $request->lang);
        }

        if ($request->has('maxprice')) {
            $books->where('price', '<', $request->maxprice);
        }

        if ($request->has('minprice')) {
            $books->where('price', '>', $request->minprice);
        }

        $books = $books->paginate($limit);

        return $this->responseSuccessWithPagination($books, [
            'data' => $this->booksTransformer->transformCollection($books->all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @todo: refactoring
     */
    public function store(Request $request)
    {
        if (!Input::get('title') || !Input::get('author') || !Input::get('rate')) {
            return $this->setStatus(422)
                        ->responseError('validation failed for creating a book');
        }

        Book::create(Input::all());

        return $this->response([
            'message' => 'Book created successfully'
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
        $book = Book::find($id);

        $book = $this->booksTransformer->transform($book);

        if (!$book) {
            return $this->responseError('book is not found');
        }

        return $this->responseSuccess([
            'data' => $book
        ]);
    }
}
