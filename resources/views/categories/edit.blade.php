@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Category</h2>
    <form method="POST" action="{{ route('categories.update',$category->id) }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $category->name }}" class="w-full border p-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection