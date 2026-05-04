<?php

namespace App\Contracts;

interface FineServiceInterface
{
    public function calculateFine(string $dueDate): int;
}