@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Category</h2>
    <form method="POST" action="{{ route('categories.store') }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf

        <input name="name" placeholder="Category Name" class="w-full border p-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection