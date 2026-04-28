<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div class="flex min-h-screen">
                <aside class="w-64 bg-slate-900 text-white p-5 space-y-3">
                    <h1 class="text-2xl font-bold mb-6">Library</h1>
                    <a href="{{ route('dashboard') }}" class="block hover:bg-slate-700 p-2 rounded-md">Dashboard</a>
                    <a href="/books" class="block hover:bg-slate-700 p-2 rounded-md">Books</a>
                    <a href="/categories" class="block hover:bg-slate-700 p-2 rounded-md">Categories</a>
                    <a href="/authors" class="block hover:bg-slate-700 p-2 rounded-md">Authors</a>
                    <a href="/members" class="block hover:bg-slate-700 p-2 rounded-md">Members</a>
                    <a href="/issue-books" class="block hover:bg-slate-700 p-2 rounded-md">Issue Books</a>
                    <a href="/issue-books" class="block hover:bg-slate-700 p-2 rounded-md">Return / History</a>
                </aside>
                <!-- Page Content -->
                <main class="flex-1 p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
