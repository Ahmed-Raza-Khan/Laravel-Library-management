<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Schema::disableForeignKeyConstraints();

        \App\Models\BookIssue::truncate();
        \App\Models\Book::truncate();
        \App\Models\Category::truncate();
        \App\Models\Author::truncate();
        \App\Models\User::where('role', 'user')->delete();

        Schema::enableForeignKeyConstraints();

        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            MemberSeeder::class,
            AdminSeeder::class,
            BookSeeder::class,
            BookIssueSeeder::class,
        ]);
    }
}
