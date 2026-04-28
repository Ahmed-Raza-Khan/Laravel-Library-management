<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Member;

class BookIssueController extends Controller
{
    public function create()
    {
        $books = Book::where('available_quantity', '>', 0)->get();
        $members = Member::where('status', 1)->get();

        return view('issues.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $book = Book::find($request->book_id);

        if($book->available_quantity <= 0){
            return back()->with('error','Book out of stock');
        }

        $already = BookIssue::where('book_id',$request->book_id)
            ->where('member_id',$request->member_id)
            ->where('status','issued')
            ->exists();

        if($already){
            return back()->with('error','Already issued');
        }

        BookIssue::create([
            'book_id'=>$request->book_id,
            'member_id'=>$request->member_id,
            'issue_date'=>now(),
            'due_date'=>$request->due_date,
            'status'=>'issued',
        ]);

        $book->decrement('available_quantity');

        return back()->with('success','Book Issued');
    }

    public function returnBook($id)
    {
        $issue = BookIssue::find($id);

        $fine = 0;

        if(now()->gt($issue->due_date)){
            $days = now()->diffInDays($issue->due_date);
            $fine = $days * 10;
        }

        $issue->update([
            'return_date'=>now(),
            'status'=>'returned',
            'fine_amount'=>$fine,
        ]);

        $issue->book->increment('available_quantity');

        return back()->with('success','Book Returned');
    }
}
