<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f8fafc] text-[#1e293b]">
        <div class="min-h-screen flex flex-col">
            {{-- Navigasi --}}
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white border-b border-slate-200 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{-- Warna teks header diatur ke Dongker pekat --}}
                        <div class="text-[#0f172a]">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main class="flex-grow">
                {{--
                   CATATAN: Pastikan di dalam {{ $slot }} (file dashboard/index),
                   Anda menggunakan Grid seperti ini agar card tetap kecil:
                   <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                --}}
                {{ $slot }}
            </main>

            <footer class="bg-white border-t border-slate-200 py-6">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">
                        &copy; {{ date('Y') }} {{ config('app.name') }} — Sistem Perpustakaan Digital
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
