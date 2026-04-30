@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Available Books</h2>

    @foreach($books as $book)
        <div class="p-3 bg-white shadow mb-2 rounded">
            <h3>{{ $book->title }}</h3>
        </div>
    @endforeach
@endsection