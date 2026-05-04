<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $this->service->create($request->all());

        return redirect()->route('categories.index')->with('success','Category added');
    }

    public function edit($id)
    {
        $category = $this->service->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->service->update($id, $request->all());

        return redirect()->route('categories.index')->with('success','Category updated');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return back()->with('success','Category deleted');
    }
}
