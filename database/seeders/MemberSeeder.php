<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\User;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $members = [
            ['name' => 'Ali Khan', 'email' => 'ali@gmail.com'],
            ['name' => 'Sara Ahmed', 'email' => 'sara@gmail.com'],
            ['name' => 'Usman Tariq', 'email' => 'usman@gmail.com'],
            ['name' => 'Ayesha Malik', 'email' => 'ayesha@gmail.com'],
            ['name' => 'Ibrahim Arham', 'email' => 'ibrahim@gmail.com'],
            ['name' => 'Kamran Naseem Agha', 'email' => 'saeed@gmail.com'],
            ['name' => 'Ali Najam Brothers', 'email' => 'najam@gmail.com'],
            ['name' => 'Phillips Komas', 'email' => 'phillips@gmail.com'],
            ['name' => 'Neckola Hexa', 'email' => 'neckola@gmail.com'],
        ];

        foreach ($members as $member) {
            User::create([
                'name' => $member['name'],
                'email' => $member['email'],
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ]);
        }

        // foreach ($members as $member) {
        //     Member::create($member);
        // }
    }
}