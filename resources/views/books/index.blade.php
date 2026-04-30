@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Books</h2>
    <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Book</a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 text-start">Title</th>
            <th class="p-3 text-start">Code</th>
            <th class="p-3 text-start">Category</th>
            <th class="p-3 text-start">Author</th>
            <th class="p-3 text-start">Qty</th>
            <th class="p-3 text-start">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($books as $book)
        <tr class="border-t">
            <td class="p-3">{{ $book->title }}</td>
            <td class="p-3">{{ $book->book_code }}</td>
            <td class="p-3">{{ $book->category->name }}</td>
            <td class="p-3">{{ $book->author->name }}</td>
            <td class="p-3">{{ $book->available_quantity }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('books.edit',$book->id) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('books.destroy',$book->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection