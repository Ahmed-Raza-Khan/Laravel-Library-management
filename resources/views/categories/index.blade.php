@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Categories</h2>
    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add</a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Name</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $cat)
        <tr class="border-t">
            <td class="p-3">{{ $cat->id }}</td>
            <td class="p-3">{{ $cat->name }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('categories.edit',$cat->id) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('categories.destroy',$cat->id) }}" method="POST" class="inline">
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