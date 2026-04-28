@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Author</h2>
    <form method="POST" action="{{ route('authors.store') }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf

        <input name="name" placeholder="Name" class="w-full border p-2">
        <textarea name="bio" placeholder="Bio" class="w-full border p-2"></textarea>

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection