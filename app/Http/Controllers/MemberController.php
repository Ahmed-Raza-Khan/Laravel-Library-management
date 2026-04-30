<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\BookIssue;
use App\Models\Book;

class MemberController extends Controller
{
    public function books()
    {
        $books = Book::latest()->get();
        return view('member.books', compact('books'));
    }

    public function history()
    {
        $issues = BookIssue::where('user_id', auth()->id())
            ->with('book')
            ->latest()
            ->get();

        return view('member.history', compact('issues'));
    }

    public function index()
    {
        $members = Member::latest()->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:members',
            'phone' => 'required',
        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 1,
        ]);

        return redirect()->route('members.index')->with('success','Member added');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('members.index')->with('success','Member updated');
    }

    public function destroy($id)
    {
        Member::destroy($id);
        return back()->with('success','Member deleted');
    }
}
