<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookIssue;

class BookIssueService
{
    /**
     * Create a new class instance.
     */
    public function issueBook($data)
    {
        $book = Book::findOrFail($data['book_id']);

        if ($book->available_quantity <= 0) {
            throw new \Exception('Book out of stock');
        }

        $already = BookIssue::where('book_id', $data['book_id'])
            ->where('member_id', $data['member_id'])
            ->where('status', 'issued')
            ->exists();

        if ($already) {
            throw new \Exception('This member already has this book');
        }

        BookIssue::create([
            'book_id' => $data['book_id'],
            'member_id' => $data['member_id'],
            'issue_date' => now(),
            'due_date' => $data['due_date'],
            'status' => 'issued',
            'fine_amount' => 0,
        ]);

        $book->decrement('available_quantity');
    }

    public function returnBook($issue)
    {
        if ($issue->status === 'returned') {
            throw new \Exception('Book already returned');
        }

        $fine = 0;

        if (now()->gt($issue->due_date)) {
            $daysLate = now()->diffInDays($issue->due_date);
            $fine = $daysLate * 10;
        }

        $issue->update([
            'return_date' => now(),
            'status' => 'returned',
            'fine_amount' => $fine,
        ]);

        $issue->book->increment('available_quantity');
    }

    public function updateOverdueStatus($issues)
    {
        foreach ($issues as $issue) {
            if ($issue->status === 'issued' && now()->gt($issue->due_date)) {
                $daysLate = now()->diffInDays($issue->due_date);

                $issue->update([
                    'status' => 'overdue',
                    'fine_amount' => $daysLate * 10,
                ]);
            }
        }
    }
}