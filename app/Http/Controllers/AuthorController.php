<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $authors = $this->service->getAll();
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

        $this->service->create($request->all());

        return redirect()->route('authors.index')->with('success','Author added');
    }

    public function edit($id)
    {
        $author = $this->service->find($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->service->update($id, $request->all());

        return redirect()->route('authors.index')->with('success','Author updated');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success','Author deleted');
    }
}
