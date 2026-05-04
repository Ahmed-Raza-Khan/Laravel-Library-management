<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return Author::latest()->get();
    }

    public function create($data)
    {
        return Author::create([
            'name' => $data['name'],
            'bio' => $data['bio'] ?? null,
            'status' => 1,
        ]);
    }

    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function update($id, $data)
    {
        $author = $this->find($id);

        $author->update([
            'name' => $data['name'],
            'bio' => $data['bio'] ?? null,
        ]);

        return $author;
    }

    public function delete($id)
    {
        return Author::destroy($id);
    }
    // public function __construct()
    // {
    //     //
    // }
}
