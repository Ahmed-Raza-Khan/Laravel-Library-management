<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Models\User;

class MemberController extends Controller
{
    protected $service;

    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    // MEMBER SIDE
    public function books()
    {
        $books = $this->service->getBooks();
        return view('member.books', compact('books'));
    }

    public function history()
    {
        $issues = $this->service->getUserHistory(auth()->id());
        return view('member.history', compact('issues'));
    }

    // ADMIN SIDE
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('members.index', compact('users'));
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

        $this->service->createMember($request->all());

        return redirect()->route('members.index')->with('success','Member added');
    }

    public function edit($id)
    {
        $member = $this->service->findMember($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $this->service->updateMember($id, $request->all());

        return redirect()->route('members.index')->with('success','Member updated');
    }

    public function destroy($id)
    {
        $this->service->deleteMember($id);
        return back()->with('success','Member deleted');
    }
}