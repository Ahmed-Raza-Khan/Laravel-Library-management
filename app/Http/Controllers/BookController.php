<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'author'])->latest()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();

        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'book_code' => 'required|unique:books',
            'category_id' => 'required',
            'author_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        Book::create([
            'title' => $request->title,
            'book_code' => $request->book_code,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'quantity' => $request->quantity,
            'available_quantity' => $request->quantity,
            'description' => $request->description,
            'status' => 1,
        ]);

        return redirect()->route('books.index')->with('success', 'Book Added');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'book_code' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $book->update([
            'title' => $request->title,
            'book_code' => $request->book_code,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('books.index')->with('success', 'Book Updated');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return back()->with('success', 'Book Deleted');
    }
}