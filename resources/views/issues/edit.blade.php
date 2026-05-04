@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Issue</h2>

    <form method="POST" action="{{ route('issues.update',$issue->id) }}" class="bg-white p-6 shadow rounded space-y-3">
    @csrf
    @method('PUT')

    <select name="book_id" class="w-full border p-2">
        @foreach($books as $book)
            <option value="{{ $book->id }}" @selected($issue->book_id == $book->id)>
                {{ $book->title }}
            </option>
        @endforeach
    </select>

    <select name="user_id" class="w-full border p-2">
        @foreach($users as $user)
            <option value="{{ $user->id }}" @selected($issue->user_id == $user->id)>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <input type="date" name="due_date" value="{{ $issue->due_date }}" class="w-full border p-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection