<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use App\Models\BookIssue;

interface BookIssueServiceInterface
{
    public function getAllIssues(): Collection;

    public function getIssueById(int $id): BookIssue;

    public function getReturnedIssues(): Collection;

    public function issueBook(int $bookId, int $userId, string $dueDate): BookIssue;

    public function returnBook(int $issueId): BookIssue;

    public function updateIssue(int $issueId, array $data): BookIssue;
}