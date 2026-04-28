@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Author</h2>
    <form method="POST" action="{{ route('authors.update',$author->id) }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $author->name }}" class="w-full border p-2">
        <textarea name="bio" class="w-full border p-2">{{ $author->bio }}</textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection