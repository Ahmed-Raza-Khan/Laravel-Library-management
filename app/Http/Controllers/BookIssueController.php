<?php

namespace App\Http\Controllers;

use App\Services\BookIssueService;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Member;

class BookIssueController extends Controller
{
    protected $service;

    public function __construct(BookIssueService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $issues = BookIssue::with(['book','member'])->latest()->get();

        $this->service->updateOverdueStatus($issues);

        return view('issues.index', compact('issues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'member_id' => 'required',
            'due_date' => 'required|date',
        ]);

        try {
            $this->service->issueBook($request->all());

            return redirect()->route('issues.index')
                ->with('success', 'Book Issued');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function returnBook($id)
    {
        $issue = BookIssue::with('book')->findOrFail($id);

        try {
            $this->service->returnBook($issue);

            return back()->with('success', 'Book returned');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $books = Book::where('available_quantity', '>', 0)->get();
        $members = Member::all();     

        return view('issues.create', compact('books', 'members'));
    }

    public function edit($id)
    {
        $issue = BookIssue::findOrFail($id);
        $books = Book::all();
        $members = Member::all();

        return view('issues.edit', compact('issue','books','members'));
    }

    public function update(Request $request, $id)
    {
        $issue = BookIssue::findOrFail($id);

        $request->validate([
            'book_id' => 'required',
            'member_id' => 'required',
            'due_date' => 'required|date',
        ]);

        $issue->update([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('issues.index')->with('success','Issue Updated');
    }

    public function history()
    {
        $issues = BookIssue::with(['book','member'])
                    ->where('status', 'returned')
                    ->latest()
                    ->get();

        return view('issues.history', compact('issues'));
    }
}

    // public function index()
    // {
    //    $issues = BookIssue::with(['book','member'])->latest()->get();

    //     foreach ($issues as $issue) {
    //         if ($issue->status === 'issued' && now()->gt($issue->due_date)) {
    //             $daysLate = now()->diffInDays($issue->due_date);

    //             $issue->update([
    //                 'status' => 'overdue',
    //                 'fine_amount' => $daysLate * 10,
    //             ]);
    //         }
    //     }

    //     return view('issues.index', compact('issues'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'book_id' => 'required|exists:books,id',
    //         'member_id' => 'required|exists:members,id',
    //         'due_date' => 'required|date|after:today',
    //     ]);

    //     $book = Book::findOrFail($request->book_id);
    //     if ($book->available_quantity <= 0) {
    //         return back()->with('error', 'Book out of stock');
    //     }

    //     $already = BookIssue::where('book_id', $request->book_id)
    //         ->where('member_id', $request->member_id)
    //         ->where('status', 'issued')
    //         ->exists();

    //     if ($already) {
    //         return back()->with('error', 'This member already has this book');
    //     }

    //     BookIssue::create([
    //         'book_id' => $request->book_id,
    //         'member_id' => $request->member_id,
    //         'issue_date' => now(),
    //         'due_date' => $request->due_date,
    //         'status' => 'issued',
    //         'fine_amount' => 0,
    //     ]);

    //     $book->decrement('available_quantity');

    //     return redirect()->route('issues.index')->with('success', 'Book Issued');
    // }
    
    // public function returnBook($id)
    // {
    //     $issue = BookIssue::with('book')->findOrFail($id);
    //     if ($issue->status === 'returned') {
    //         return back()->with('error', 'Book already returned');
    //     }

    //     $fine = 0;
    //     if (now()->gt($issue->due_date)) {
    //         $daysLate = now()->diffInDays($issue->due_date);
    //         $fine = $daysLate * 10;
    //     }

    //     $issue->update([
    //         'return_date' => now(),
    //         'status' => 'returned',
    //         'fine_amount' => $fine,
    //     ]);

    //     $issue->book->increment('available_quantity');

    //     return redirect()->route('issues.index')
    //         ->with('success', 'Book returned successfully');
    // }