@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add Member</h2>
    <form method="POST" action="{{ route('members.store') }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf

        <input name="name" placeholder="Name" class="w-full border p-2">
        <input name="email" placeholder="Email" class="w-full border p-2">
        <input name="phone" placeholder="Phone" class="w-full border p-2">
        <input name="address" placeholder="Address" class="w-full border p-2">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection