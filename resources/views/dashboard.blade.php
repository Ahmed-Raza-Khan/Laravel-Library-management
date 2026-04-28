@extends('layouts.app')

@section('content')
    <h2 class="text-5xl font-bold mb-10">Dashboard</h2>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Total Books: {{ $books }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Members: {{ $members }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Issued: {{ $issued }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Returned: {{ $returned }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Overdue: {{ $overdue }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Available: {{ $available }}</div>
    </div>
@endsection