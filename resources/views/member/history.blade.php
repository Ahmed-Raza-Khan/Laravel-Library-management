@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">My Issued History</h2>

    @foreach($issues as $issue)
        <div class="p-3 bg-white shadow mb-2 rounded">
            <p>Book: {{ $issue->book->title }}</p>
            <p>Status: {{ $issue->status }}</p>
        </div>
    @endforeach
@endsection