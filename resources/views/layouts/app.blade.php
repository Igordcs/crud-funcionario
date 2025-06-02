<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3 w-80">
        @if (session('success'))
            <div
                class="notification bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg flex items-start">
                <div class="flex-shrink-0 pt-0.5">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-3 text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div
                class="notification bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg flex items-start">
                <div class="flex-shrink-0 pt-0.5">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium">{{ $errors->first() }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-3 text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('.notification');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 5000);

            setTimeout(() => {
                notification.style.transition = 'opacity 0.3s ease';
            }, 10);
        });
    });
</script>

</html>
