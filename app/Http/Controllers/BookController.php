<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Exports\BooksExport; //add the export file
use Maatwebsite\Excel\Facades\Excel; //add excel export facades

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books= Book::all();
        // return Book::all();
        return view('books.index')->with(['books'=>$books]);
        // return response()->json([$books,'status'=>'ok'],200);
        // return response([
        //     'status'=>'ok'
        // ],200);
        // return response(view('books.index',array('books'=>$books)),200, ['Content-Type' => 'application/json']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // $book = new Book;
        // $book->title = $request->input('title');
        // $book->memo = $request->input('memo');
        // $book->save();
        Book::create($request->all( ));

        return response()->json([
            "message" => "Book was successfully created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new BooksExport, 'books.csv');
        // return (new BooksExport)->download('books.csv', Excel::CSV, ['Content-Type' => 'text/csv']);    
    }
}
