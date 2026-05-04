<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Models\Category;
use App\Models\Author;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $books = $this->service->getAllBooks();
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

        $this->service->createBook($request->all());

        return redirect()->route('books.index')->with('success', 'Book Added');
    }

    public function edit($id)
    {
        $book = $this->service->findBook($id);
        $categories = Category::all();
        $authors = Author::all();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'book_code' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $this->service->updateBook($id, $request->all());

        return redirect()->route('books.index')->with('success', 'Book Updated');
    }

    public function destroy($id)
    {
        $this->service->deleteBook($id);

        return back()->with('success', 'Book Deleted');
    }
}