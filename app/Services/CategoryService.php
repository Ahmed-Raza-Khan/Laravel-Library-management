<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return Category::latest()->get();
    }

    public function create($data)
    {
        return Category::create([
            'name' => $data['name'],
            'status' => 1,
        ]);
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function update($id, $data)
    {
        $category = $this->find($id);

        $category->update([
            'name' => $data['name'],
        ]);

        return $category;
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }
    // public function __construct()
    // {
    //     //
    // }
}
