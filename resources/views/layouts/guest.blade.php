<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center
                pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-white to-slate-100 px-4">

        <!-- Brand -->
        <div class="mb-6">
            <a href="/" class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600
                             flex items-center justify-center text-white font-bold shadow-md">
                    M
                </span>
                <span class="text-2xl font-bold tracking-tight text-slate-900">
                    My<span class="text-blue-600">Shop</span>
                </span>
            </a>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/60
                    px-6 py-6 sm:px-8 sm:py-8">
            {{ $slot }}
        </div>

        <p class="mt-6 text-xs text-slate-400">
            &copy; {{ date('Y') }} MyShop. All rights reserved.
        </p>
    </div>
</body>
</html>