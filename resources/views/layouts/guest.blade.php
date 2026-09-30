<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen grid lg:grid-cols-2">

            <!-- LEFT: brand panel -->
            <div class="hidden lg:flex flex-col justify-between p-12 relative overflow-hidden
                        bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 text-white">

                <!-- Decorative blur circles -->
                <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl"></div>

                <div class="relative z-10">
                    <span class="text-2xl font-bold tracking-tight">
                        My<span class="text-blue-400">Shop</span>
                    </span>
                </div>

                <div class="relative z-10 max-w-md">
                    <h2 class="text-4xl font-bold leading-tight tracking-tight">
                        Everything you need,<br>
                        <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">
                            in one cart.
                        </span>
                    </h2>
                    <p class="mt-5 text-slate-300 leading-relaxed">
                        Browse categories, track orders, and check out in seconds — all from one clean dashboard.
                    </p>
                </div>

                <p class="relative z-10 text-xs text-slate-400">
                    &copy; {{ date('Y') }} MyShop. All rights reserved.
                </p>
            </div>

            <!-- RIGHT: form -->
            <div class="flex items-center justify-center p-6 sm:p-10 bg-gradient-to-br from-white to-slate-50">
                <div class="w-full max-w-md">

                    <!-- Mobile brand -->
                    <div class="lg:hidden mb-10 text-center">
                        <span class="text-2xl font-bold tracking-tight">
                            My<span class="text-blue-600">Shop</span>
                        </span>
                    </div>

                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>