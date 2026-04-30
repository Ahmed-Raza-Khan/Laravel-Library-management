@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Book Issues</h2>
        <a href="{{ route('issues.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Issue Book</a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-start">Book</th>
                <th class="p-3 text-start">Member</th>
                <th class="p-3 text-start">Issue Date</th>
                <th class="p-3 text-start">Due Date</th>
                <th class="p-3 text-start">Status</th>
                <th class="p-3 text-start">Fine</th>
                <th class="p-3 text-start">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($issues as $issue)
            @php
                $isOverdue = $issue->status === 'issued' && now()->gt($issue->due_date);
                $fine = $isOverdue ? now()->diffInDays($issue->due_date) * 10 : 0;
            @endphp
                <tr class="border-t">
                    <td class="p-3">{{ $issue->book->title }}</td>
                    <td class="p-3">{{ $issue->member->name }}</td>
                    <td class="p-3">{{ $issue->issue_date }}</td>
                    <td class="p-3">{{ $issue->due_date }}</td>
                    <td class="p-3">{{ $issue->status }}</td>
                    <td class="p-3">
                        @if($issue->status === 'returned')
                            {{ (int) $issue->fine_amount }}
                        @elseif(now()->gt($issue->due_date))
                            {{ (int)(now()->diffInDays($issue->due_date) * 10) }}
                        @else
                            0
                        @endif
                    </td>

                     <td class="p-3 space-x-2">
                        <a href="{{ route('issues.edit', $issue->id) }}" class="text-blue-600">
                            Edit
                        </a>

                        {{-- ALWAYS show return if NOT returned --}}
                        @if($issue->status !== 'returned')
                            <form action="{{ route('issues.return', $issue->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="text-green-600 hover:underline">
                                    Return
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection