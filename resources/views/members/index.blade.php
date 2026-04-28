@extends('layouts.app')

@section('content')
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Members</h2>
        <a href="{{ route('members.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add</a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">Phone</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($members as $m)
                <tr class="border-t">
                    <td class="p-3">{{ $m->id }}</td>
                    <td class="p-3">{{ $m->name }}</td>
                    <td class="p-3">{{ $m->email }}</td>
                    <td class="p-3">{{ $m->phone }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('members.edit',$m->id) }}" class="text-blue-600">Edit</a>

                        <form action="{{ route('members.destroy',$m->id) }}" method="POST" class="inline">
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