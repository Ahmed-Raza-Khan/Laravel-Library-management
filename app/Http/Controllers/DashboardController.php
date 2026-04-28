<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Member;
use App\Models\BookIssue;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard',[
            'books' => Book::count(),
            'members' => Member::count(),
            'issued' => BookIssue::where('status','issued')->count(),
            'returned' => BookIssue::where('status','returned')->count(),
            'overdue' => BookIssue::where('status','issued')
                        ->whereDate('due_date','<',now())
                        ->count(),
            'available' => Book::sum('available_quantity'),
        ]);
    }
}