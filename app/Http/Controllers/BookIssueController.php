<?php

namespace App\Http\Controllers;

use App\Services\BookIssueService;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\User;

class BookIssueController extends Controller
{
    protected $service;

    public function __construct(BookIssueService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $issues = BookIssue::with(['book','user'])->latest()->get();

        $this->service->updateOverdueStatus($issues);

        return view('issues.index', compact('issues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
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
        $users = user::where('role', 'user')->get();     

        return view('issues.create', compact('books', 'users'));
    }

    public function edit($id)
    {
        $issue = BookIssue::findOrFail($id);
        $books = Book::all();
        $users = User::where('role', 'user')->get();

        return view('issues.edit', compact('issue','books','users'));
    }

    public function update(Request $request, $id)
    {
        // $issue = BookIssue::findOrFail($id);

        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'due_date' => 'required|date',
        ]);

        $issue->update($request->only([
            'book_id',
            'user_id',
            'due_date'
        ]));

        return redirect()->route('issues.index')->with('success','Issue Updated');
    }

    public function history()
    {
        $issues = BookIssue::with(['book','user'])
                    ->where('status', 'returned')
                    ->latest()
                    ->get();

        return view('issues.history', compact('issues'));
    }
}
