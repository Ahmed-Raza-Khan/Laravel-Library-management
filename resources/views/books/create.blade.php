@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Book</h2>
    <form method="POST" action="{{ route('books.store') }}" class="space-y-3 bg-white p-6 rounded shadow">
    @csrf

        <input name="title" placeholder="Title" class="w-full border p-2">
        <input name="book_code" placeholder="Book Code" class="w-full border p-2">
            <select name="category_id" class="w-full border p-2">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="author_id" class="w-full border p-2">
                @foreach($authors as $a)
                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                @endforeach
            </select>
            
        <input name="quantity" type="number" placeholder="Quantity" class="w-full border p-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection