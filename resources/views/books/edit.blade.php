@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Book</h2>
    <form method="POST" action="{{ route('books.update',$book->id) }}" class="space-y-3 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <input name="title" value="{{ $book->title }}" class="w-full border p-2">
        <input name="book_code" value="{{ $book->book_code }}" class="w-full border p-2">
        <select name="category_id" class="w-full border p-2">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected($book->category_id==$cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="author_id" class="w-full border p-2">
            @foreach($authors as $a)
                <option value="{{ $a->id }}" @selected($book->author_id==$a->id)>
                    {{ $a->name }}
                </option>
            @endforeach
        </select>

        <input name="quantity" value="{{ $book->quantity }}" class="w-full border p-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection