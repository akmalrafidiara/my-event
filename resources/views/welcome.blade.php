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
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="container mx-auto my-6 px-4">

            {{-- Banner Section --}}
            <div class="banner mb-6">
                <img src="{{ Storage::url('images/banner.jpg') }}" alt="Event Banner" class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            {{-- Upcoming Events --}}
            <div class="container mx-auto mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-center">Upcoming Events</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($upcomingEvents as $event)
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">Start: {{ $event->start_event_at->format('d M, Y') }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:text-blue-700 mt-3 inline-block">Details</a>
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
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">End: {{ $event->end_event_at->format('d M, Y') }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:text-blue-700 mt-3 inline-block">Details</a>
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
                        <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ Storage::url($event->featured_image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                            <div class="p-4 bg-white">
                                <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                <p class="text-sm text-gray-600">Status: Open</p>
                                <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:text-blue-700 mt-3 inline-block">Details</a>
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
