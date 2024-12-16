<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="{{ route('events.index') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back
                    </a>
            </div>
        </div>

    <div class="bg-gradient-to-b from-purple-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Event Header Section -->
            <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ Storage::url($event->featured_image) }}" alt="Event Image" class="w-full h-72 object-cover">
                <div class="absolute inset-0 flex flex-col justify-center items-start px-6 py-8 space-y-3">
                    <h1 class="text-4xl font-extrabold">{{ $event->title }}</h1>
                    <p class="text-lg text-gray-200 flex items-center">
                        <i class="fas fa-map-marker-alt text-yellow-400 mr-2"></i>{{ $event->location }}
                    </p>
                    <div class="flex space-x-4">
                        <span class="px-4 py-1 bg-green-500 text-white rounded-full text-sm font-semibold capitalize">
                            {{ $event->status }}
                        </span>
                        <span class="px-4 py-1 bg-blue-500 text-white rounded-full text-sm font-semibold capitalize">
                            {{ $event->category->name }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Event Details Section -->
            <div class="bg-white rounded-lg shadow-md p-6 space-y-6">

                <div class="text-left space-y-3 pb-3">
                    <h2 class="text-2xl font-semibold text-gray-800">About This Event</h2>
                    <p class="text-gray-600">{{ $event->description }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Date Details -->
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 rounded-lg p-4 text-center">
                        <h3 class="text-lg font-bold text-blue-800">Start Date</h3>
                        <p class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($event->start_event_at)->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-purple-100 to-purple-200  rounded-lg p-4 text-center">
                        <h3 class="text-lg font-bold text-purple-800">End Date</h3>
                        <p class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($event->end_event_at)->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gradient-to-r from-green-100 to-green-200 rounded-lg p-4 text-center">
                        <h3 class="text-lg font-bold text-green-800">Quota</h3>
                        <p class="text-sm text-gray-700">{{ $event->quota }} people</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div class="p-4 bg-yellow-50 rounded-lg shadow-sm">
                        <h3 class="text-lg font-bold text-yellow-800">Price</h3>
                        <p class="text-gray-700">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-4 bg-red-50 rounded-lg shadow-sm">
                        <h3 class="text-lg font-bold text-red-800">Minimum Age</h3>
                        <p class="text-gray-700">{{ $event->min_age }} Y.O</p>
                    </div>
                </div>

                    <!-- Register Button -->
                    @if (auth()->user()->role == 'user')
                        <div class="text-center">
                            <form action="{{ route('registrants.register', $event->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button class="inline-block bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white font-medium px-8 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2">
                                    Register Now!
                                </button>
                            </form>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</x-app-layout>