<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();

        foreach (range(1, 20) as $i) {
            Book::create([
                'title' => 'Book ' . $i,
                'book_code' => 'BK-' . rand(1000, 9999),
                'category_id' => $categories->random()->id,
                'author_id' => $authors->random()->id,
                'publisher' => 'Random Publisher',
                'isbn' => rand(100000, 999999),
                'quantity' => 10,
                'available_quantity' => 10,
                'description' => 'Sample book description',
                'status' => 1
            ]);
        }
    }
}
