@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-5">Issue Book</h2>
    <form method="POST" action="{{ route('issue.store') }}" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf    
        <select name="book_id" class="w-full border p-3 rounded">
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <select name="member_id" class="w-full border p-3 rounded">
           @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
            @endforeach
        </select>
        <input type="date" name="due_date" class="w-full border p-3 rounded">
        <button class="bg-green-600 text-white px-5 py-2 rounded">Issue</button>
    </form>
@endsection