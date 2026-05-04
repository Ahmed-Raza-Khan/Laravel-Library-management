@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Issue Book</h2>

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 mb-3">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('issues.store') }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf

        <select name="book_id" class="w-full border p-2">
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>

        <select name="user_id" class="w-full border p-2">
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="due_date" class="w-full border p-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Issue</button>
    </form>
@endsection