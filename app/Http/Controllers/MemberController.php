<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;

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
        $members = $this->service->getAllMembers();
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

    // public function books()
    // {
    //     $books = Book::latest()->get();
    //     return view('member.books', compact('books'));
    // }

    // public function history()
    // {
    //     $issues = BookIssue::where('user_id', auth()->id())
    //         ->with('book')
    //         ->latest()
    //         ->get();

    //     return view('member.history', compact('issues'));
    // }

    // public function index()
    // {
    //     $members = Member::latest()->get();
    //     return view('members.index', compact('members'));
    // }

    // public function create()
    // {
    //     return view('members.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:members',
    //         'phone' => 'required',
    //     ]);

    //     Member::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'status' => 1,
    //     ]);

    //     return redirect()->route('members.index')->with('success','Member added');
    // }

    // public function edit($id)
    // {
    //     $member = Member::findOrFail($id);
    //     return view('members.edit', compact('member'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $member = Member::findOrFail($id);

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);

    //     $member->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //     ]);

    //     return redirect()->route('members.index')->with('success','Member updated');
    // }

    // public function destroy($id)
    // {
    //     Member::destroy($id);
    //     return back()->with('success','Member deleted');
    // }
}
