<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookIssue;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class BookIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $members = Member::all();

        foreach (range(1, 10) as $i) {

            $issueDate = Carbon::now()->subDays(rand(1, 20));
            $dueDate = (clone $issueDate)->addDays(7);

            $isReturned = rand(0, 1);

            BookIssue::create([
                'book_id' => $books->random()->id,
                'member_id' => $members->random()->id,
                'issue_date' => $issueDate,
                'due_date' => $dueDate,
                'return_date' => $isReturned ? Carbon::now() : null,
                'status' => $isReturned ? 'returned' : 'issued',
                'fine_amount' => 0
            ]);
        }
    }
}
