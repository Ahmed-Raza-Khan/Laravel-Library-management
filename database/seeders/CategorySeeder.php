<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Science',
            'Technology',
            'History',
            'Math',
            'Literature'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'status' => 1
            ]);
        }
    }
}
