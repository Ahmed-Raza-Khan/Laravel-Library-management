<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J. K. Rowling',
            'bio' => 'Fantasy writer',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Yuval Noah Harari',
            'bio' => 'Historian & author',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Stephen Hawking',
            'bio' => 'Scientist & physicist',
            'status' => 1
        ]);
    }
}
