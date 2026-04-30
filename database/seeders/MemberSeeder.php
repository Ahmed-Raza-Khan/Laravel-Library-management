<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'Ali Khan', 'email' => 'ali@gmail.com', 'phone' => '03001111111', 'address' => 'Karachi', 'status' => 1],
            ['name' => 'Sara Ahmed', 'email' => 'sara@gmail.com', 'phone' => '03002222222', 'address' => 'Lahore', 'status' => 1],
            ['name' => 'Usman Tariq', 'email' => 'usman@gmail.com', 'phone' => '03003333333', 'address' => 'Islamabad', 'status' => 1],
            ['name' => 'Ayesha Malik', 'email' => 'ayesha@gmail.com', 'phone' => '03004444444', 'address' => 'Karachi', 'status' => 1],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
