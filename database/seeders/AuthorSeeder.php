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
            'name' => 'john linkin',
            'bio' => 'Scientist & physicist',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Abraham Waski',
            'bio' => 'Dream World',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Sam Tisen',
            'bio' => 'Unicorn Creator',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Keral Askim',
            'bio' => 'Sonya bir jecksaniz',
            'status' => 1
        ]);

        Author::create([
            'name' => 'Altan bir fatih',
            'bio' => 'Bosnia danda Farmanachez',
            'status' => 1
        ]);
    }
}
