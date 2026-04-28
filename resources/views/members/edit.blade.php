@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit Member</h2>
    <form method="POST" action="{{ route('members.update',$member->id) }}" class="bg-white p-6 shadow rounded space-y-3">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $member->name }}" class="w-full border p-2">
        <input name="email" value="{{ $member->email }}" class="w-full border p-2">
        <input name="phone" value="{{ $member->phone }}" class="w-full border p-2">
        <input name="address" value="{{ $member->address }}" class="w-full border p-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection