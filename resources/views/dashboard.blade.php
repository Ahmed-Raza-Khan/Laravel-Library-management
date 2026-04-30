@extends('layouts.app')

@section('content')
    <h2 class="text-5xl font-bold mb-10">Dashboard</h2>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow"><a href="/books">Total Books: {{ $books }}</a></div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow"><a href="/members">Members: {{ $members }}</a></div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow"><a href="/issues">Issued: {{ $issued }}</a></div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow"><a href="/return-history">Returned: {{ $returned }}</a></div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Overdue: {{ $overdue }}</div>
        <div class="bg-slate-900 text-white p-6 rounded-xl shadow">Available: {{ $available }}</div>
    </div>
@endsection