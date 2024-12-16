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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="container mx-auto my-6 px-4">

            {{-- Banner Section --}}
            <div class="banner mb-6">
                <img src="{{ Storage::url('images/banner.jpg') }}" alt="Event Banner" class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            {{-- About Section --}}
            <div class="about mb-12 text-center bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">About Us</h2>
                <p class="text-lg text-gray-600 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            {{-- Upcoming Events --}}
            <div class="container mx-auto mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-center">Upcoming Events</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($upcomingEvents as $event)
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 cursor-pointer" onclick="window.location='{{ route('events.show', $event->id) }}'">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">Start: {{ $event->start_event_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No upcoming events found.</p>
                    @endforelse
                </div>
            </div>

            {{-- Ongoing Events --}}
            <div class="container mx-auto mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-center">Ongoing Events</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($ongoingEvents as $event)
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 cursor-pointer" onclick="window.location='{{ route('events.show', $event->id) }}'">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">End: {{ $event->end_event_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No ongoing events found.</p>
                    @endforelse
                </div>
            </div>

            {{-- Open Events --}}
            <div class="container mx-auto mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-center">Open Events</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($openEvents as $event)
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 cursor-pointer" onclick="window.location='{{ route('events.show', $event->id) }}'">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">Status: Open</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No open events found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</body>
</html>
