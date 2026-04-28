@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Authors</h2>
        <a href="{{ route('authors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add</a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Bio</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($authors as $a)
                <tr class="border-t">
                    <td class="p-3">{{ $a->id }}</td>
                    <td class="p-3">{{ $a->name }}</td>
                    <td class="p-3">{{ $a->bio }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('authors.edit',$a->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('authors.destroy',$a->id) }}" method="POST" class="inline">
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