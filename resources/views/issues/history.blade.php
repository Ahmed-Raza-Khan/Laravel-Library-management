@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Return History</h2>
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-start">Book</th>
                <th class="p-3 text-start">Member</th>
                <th class="p-3 text-start">Issue Date</th>
                <th class="p-3 text-start">Return Date</th>
                <th class="p-3 text-start">Fine</th>
            </tr>
        </thead>

        <tbody>
            @forelse($issues as $issue)
                <tr class="border-t">
                    <td class="p-3">{{ $issue->book->title }}</td>
                    <td class="p-3">{{ $issue->member->name }}</td>
                    <td class="p-3">{{ $issue->issue_date }}</td>
                    <td class="p-3">{{ $issue->return_date }}</td>
                    <td class="p-3">
                        @if(!is_null($issue->fine_amount) && $issue->fine_amount > 0)
                            <span class="text-red-600 font-semibold">
                                Rs. {{ number_format($issue->fine_amount) }}
                            </span>
                        @else
                            <span class="text-green-600">No Fine</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No return history found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection