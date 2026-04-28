@extends('layouts.app')
@section('content')
    <h2 class="text-2xl font-bold mb-5">Issued Books History</h2>
    <table class="w-full bg-white rounded-xl shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Book</th>
                <th class="p-3">Member</th>
                <th class="p-3">Status</th>
                <th class="p-3">Fine</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issues as $issue)
                <tr class="border-t">
                    <td class="p-3">{{ $issue->book->title }}</td>
                    <td class="p-3">{{ $issue->member->name }}</td>
                    <td class="p-3">{{ $issue->status }}</td>
                    <td class="p-3">{{ $issue->fine_amount }}</td>
                    <td class="p-3">
                        @if($issue->status == 'issued')
                        <a href="/return-book/{{ $issue->id }}" class="text-green-600">Return</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection