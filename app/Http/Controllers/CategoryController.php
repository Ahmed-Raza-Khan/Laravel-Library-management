<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
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

        Category::create([
            'name' => $request->name,
            'status' => 1,
        ]);

        return redirect()->route('categories.index')->with('success','Category added');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success','Category updated');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('success','Category deleted');
    }
}
