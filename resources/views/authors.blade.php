@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-5">
        <h2 class="text-2xl font-bold">Authors</h2>
        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded">Add New Author</a>
    </div>
    <table class="w-full bg-white shadow rounded-xl overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->id }}</td>
                    <td class="p-3">{{ $item->name }}</td>
                    <td class="p-3 space-x-2">
                        <a href="#" class="text-blue-600">Edit</a>
                        <a href="#" class="text-red-600">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection