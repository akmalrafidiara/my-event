<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 min-h-screen flex items-center justify-center font-Poppins">

    <div class="text-center p-8 rounded-xl shadow-lg bg-white bg-opacity-80 w-full max-w-lg">
        <!-- Logo/Title -->
        <h1 class="text-5xl font-semibold text-gray-800 mb-6 tracking-wide">Welcome to {{ config('app.name', 'Laravel') }}</h1>

        <!-- Description -->
        <p class="text-lg text-gray-600 mb-8">We are excited to have you here! Please log in or register to get started.</p>

        <!-- Buttons -->
        <div class="space-x-4">
            <!-- Login Button -->
            <a href="{{ route('login') }}" class="inline-block px-10 py-3 text-lg font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 mb-4 sm:mb-0">Login</a>

            <!-- Register Button -->
            <a href="{{ route('register') }}" class="inline-block px-10 py-3 text-lg font-semibold text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition-all duration-300 transform hover:scale-105">Register</a>
        </div>

        <!-- Small Footer -->
        <div class="mt-12 text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
