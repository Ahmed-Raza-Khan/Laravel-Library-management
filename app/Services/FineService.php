<?php

namespace App\Services;

use App\Contracts\FineServiceInterface;

class FineService implements FineServiceInterface
{
    public function calculateFine(string $dueDate): int
    {
        if (now()->lte($dueDate)) {
            return 0;
        }

        $daysLate = now()->diffInDays($dueDate);

        return $daysLate * config('library.fine_per_day', 10);
    }
}