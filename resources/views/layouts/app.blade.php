<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            .sidebar {
                transition: all 0.3s ease-in-out;
            }
            .content {
                transition: all 0.3s ease-in-out;
            }
            [x-cloak] {
                display: none !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <x-banner />

        <!-- Sidebar -->
        <x-layout.sidebar />

        <!-- Main Content -->
        <div class="flex flex-col min-h-screen" :class="sidebarOpen ? 'ml-64' : 'ml-16'">
            <!-- Navbar -->
            <x-layout.navbar />

            <!-- Page Content -->
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
