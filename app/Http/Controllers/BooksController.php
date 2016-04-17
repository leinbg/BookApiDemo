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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        $books = $this->booksTransformer->transformCollection($books->toArray());

        return $this->responseSuccess($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        return $this->responseSuccess($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
