<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year');
        $status = $request->input('status');

        $result = Book::query()
        ->when($year, function($query) use ($year) {
            $query->where('published_year', 'like', "%{$year}%");
        })
        ->when($status, function($query) use ($status) {
            $query->where('status', 'like', "%{$status}%");
        }
        )->paginate(10)
        ->withQueryString();

        return Inertia::render('Book/Index', [
            'result' => fn () => $result,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Book/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        $book = Book::create($data);

       return to_route('book.index')->with('message','record added Successfully', );
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return Inertia::render('Book/Show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return Inertia::render('Book/Edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $book->update($data);

        return to_route('book.index')->with('message','record updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return to_route('book.index')->with('message','record deleted Successfully', );
    }

    
}
