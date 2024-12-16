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
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('layouts.navigation')

        <div class="container mx-auto my-6 px-4">

            <!-- Banner Section -->
            <div class="mb-6">
                <img 
                    src="{{ Storage::url('images/banner.jpg') }}" 
                    alt="Event Banner" 
                    class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <!-- Section Template -->
            @foreach ([
                ['title' => 'Upcoming Events', 'events' => $upcomingEvents, 'message' => 'No upcoming events found.'],
                ['title' => 'Ongoing Events', 'events' => $ongoingEvents, 'message' => 'No ongoing events found.'],
                ['title' => 'Open Events', 'events' => $openEvents, 'message' => 'No open events found.']
            ] as $section)
                <div class="mb-12">
                    <h2 class="text-3xl font-semibold mb-6 text-center">{{ $section['title'] }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($section['events'] as $event)
                            <div class="card shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                                <img 
                                    src="{{ Storage::url($event->featured_image) }}" 
                                    alt="{{ $event->title }}" 
                                    class="w-full h-48 object-cover">
                                <div class="p-4 bg-white">
                                    <h5 class="text-lg font-bold text-gray-800">{{ $event->title }}</h5>
                                    @if ($section['title'] === 'Upcoming Events')
                                        <p class="text-sm text-gray-600">Start: {{ $event->start_event_at->format('d M, Y') }}</p>
                                    @elseif ($section['title'] === 'Ongoing Events')
                                        <p class="text-sm text-gray-600">End: {{ $event->end_event_at->format('d M, Y') }}</p>
                                    @else
                                        <p class="text-sm text-gray-600">Status: Open</p>
                                    @endif
                                    <a 
                                        href="{{ route('events.show', $event->id) }}" 
                                        class="text-blue-500 hover:text-blue-700 mt-3 inline-block">Details</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600">{{ $section['message'] }}</p>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</body>
</html>
