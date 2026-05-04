<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    /**
     * Create a new class instance.
     */
    public function getAllBooks()
    {
        return Book::with(['category', 'author'])->latest()->get();
    }

    public function createBook($data)
    {
        return Book::create([
            'title' => $data['title'],
            'book_code' => $data['book_code'],
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id'],
            'publisher' => $data['publisher'] ?? null,
            'isbn' => $data['isbn'] ?? null,
            'quantity' => $data['quantity'],
            'available_quantity' => $data['quantity'],
            'description' => $data['description'] ?? null,
            'status' => 1,
        ]);
    }

    public function findBook($id)
    {
        return Book::findOrFail($id);
    }

    public function updateBook($id, $data)
    {
        $book = $this->findBook($id);

        $book->update([
            'title' => $data['title'],
            'book_code' => $data['book_code'],
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id'],
            'publisher' => $data['publisher'] ?? null,
            'isbn' => $data['isbn'] ?? null,
            'quantity' => $data['quantity'],
            'description' => $data['description'] ?? null,
        ]);

        return $book;
    }

    public function deleteBook($id)
    {
        return Book::destroy($id);
    }
}
