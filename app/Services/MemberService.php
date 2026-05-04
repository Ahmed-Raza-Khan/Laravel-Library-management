<?php

namespace App\Services;

use App\Models\User;
use App\Models\Book;
use App\Models\BookIssue;

class MemberService
{
    /**
     * Create a new class instance.
     */
    public function getAllMembers()
    {
        return User::where('role', 'user')->latest()->get();
        // return Member::latest()->get();
    }

    public function createMember($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt('12345678'),
            'address' => $data['address'] ?? null,
            'status' => 1,
            'role' => 'user',
        ]);
    }

    public function findMember($id)
    {
        return User::findOrFail($id);
    }

    public function updateMember($id, $data)
    {
        $user = $this->findMember($id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'] ?? null,
        ]);

        return $user;
    }

    public function deleteMember($id)
    {
        return User::destroy($id);
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
