<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->get();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'status' => 1,
        ]);

        return redirect()->route('authors.index')->with('success','Author added');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
        ]);

        return redirect()->route('authors.index')->with('success','Author updated');
    }

    public function destroy($id)
    {
        Author::destroy($id);
        return back()->with('success','Author deleted');
    }
}