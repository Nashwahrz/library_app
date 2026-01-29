<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f8fafc] text-[#1e293b]">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            <div class="transition-transform duration-500 hover:scale-110">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#0f172a]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 overflow-hidden sm:rounded-2xl">

                <div class="mb-8 text-center">
                    <h1 class="text-2xl font-bold text-[#0f172a]">Selamat Datang</h1>
                    <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun perpustakaan Anda</p>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-8 text-center">
                <p class="text-xs text-slate-400 uppercase tracking-widest font-medium">
                    &copy; {{ date('Y') }} Perpustakaan Digital
                </p>
            </div>
        </div>
    </body>
</html>
