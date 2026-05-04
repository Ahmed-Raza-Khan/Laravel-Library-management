<?php

namespace App\Services;

use App\Contracts\BookIssueServiceInterface;
use App\Contracts\FineServiceInterface;
use App\Models\Book;
use App\Models\BookIssue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookIssueService implements BookIssueServiceInterface
{
    protected FineServiceInterface $fineService;

    public function __construct(FineServiceInterface $fineService)
    {
        $this->fineService = $fineService;
    }

    public function getAllIssues(): Collection
    {
        return BookIssue::with(['book', 'user'])->latest()->get();
    }

    public function getIssueById(int $id): BookIssue
    {
        return BookIssue::with(['book', 'user'])->findOrFail($id);
    }

    public function getReturnedIssues(): Collection
    {
        return BookIssue::with(['book', 'user'])
            ->where('status', 'returned')
            ->latest()
            ->get();
    }

    public function issueBook(int $bookId, int $userId, string $dueDate): BookIssue
    {
        return DB::transaction(function () use ($bookId, $userId, $dueDate) {

            $book = Book::findOrFail($bookId);

            if ($book->available_quantity <= 0) {
                throw new \Exception('Book out of stock');
            }

            $alreadyIssued = BookIssue::where('book_id', $bookId)
                ->where('user_id', $userId)
                ->where('status', 'issued')
                ->exists();

            if ($alreadyIssued) {
                throw new \Exception('User already has this book');
            }

            $issue = BookIssue::create([
                'book_id' => $bookId,
                'user_id' => $userId,
                'issue_date' => now(),
                'due_date' => $dueDate,
                'status' => 'issued',
                'fine_amount' => 0
            ]);

            $book->decrement('available_quantity');

            return $issue;
        });
    }

    public function returnBook(int $issueId): BookIssue
    {
        return DB::transaction(function () use ($issueId) {

            $issue = BookIssue::with('book')->findOrFail($issueId);

            if ($issue->status === 'returned') {
                throw new \Exception('Book already returned');
            }

            $fine = $this->fineService->calculateFine($issue->due_date);

            $issue->update([
                'return_date' => now(),
                'status' => 'returned',
                'fine_amount' => $fine
            ]);

            $issue->book->increment('available_quantity');

            return $issue;
        });
    }

    public function updateIssue(int $issueId, array $data): BookIssue
    {
        $issue = BookIssue::findOrFail($issueId);

        $issue->update([
            'book_id' => $data['book_id'],
            'user_id' => $data['user_id'],
            'due_date' => $data['due_date']
        ]);

        return $issue;
    }
}