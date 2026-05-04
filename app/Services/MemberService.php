<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Book;
use App\Models\BookIssue;

class MemberService
{
    /**
     * Create a new class instance.
     */
    public function getAllMembers()
    {
        return Member::latest()->get();
    }

    public function createMember($data)
    {
        return Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? null,
            'status' => 1,
        ]);
    }

    public function findMember($id)
    {
        return Member::findOrFail($id);
    }

    public function updateMember($id, $data)
    {
        $member = $this->findMember($id);

        $member->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? null,
        ]);

        return $member;
    }

    public function deleteMember($id)
    {
        return Member::destroy($id);
    }

    // MEMBER SIDE

    public function getBooks()
    {
        return Book::latest()->get();
    }

    public function getUserHistory($userId)
    {
        return BookIssue::where('user_id', $userId)
            ->with('book')
            ->latest()
            ->get();
    }
    // public function __construct()
    // {
    //     //
    // }
}
