<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __($event->title) }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __($event->description) }}
                    </p>
                </header>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex gap-4">
                    <div class="w-1/3">
                        <img src="{{ Storage::url($event->featured_image) }}" alt="" class="w-full rounded-lg">
                    </div>
                    <div class="w-3/4">
                        <div class="flex justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-8s00">{{ $event->title }}</h1>

                                <p class="text-sm text-gray-500 flex items-center">
                                    {{ $event->location }}
                                </p>
                            </div>
                            <div>
                                <!-- Status -->
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold capitalize
                                        {{ $event->status === 'open' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $event->status }}
                                    </span>
                                    <span
                                        class="inline-flex px-3 py-1 rounded-full text-xs font-semibold capitalize text-white bg-indigo-600">
                                        {{ $event->category->name }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="text-gray-700 text-sm leading-relaxed">
                                {{ $event->description }}
                            </p>
                        </div>

                        <div class="mt-2">
                            <div class="text-sm text-gray-500 flex flex-col gap-1">
                                <p class="flex items-center">
                                    <span>Start:
                                        {{ \Carbon\Carbon::parse($event->start_event_at)->format('d M Y') }}</span>
                                </p>
                                <p class="flex items-center">
                                    <span>End:
                                        {{ \Carbon\Carbon::parse($event->end_event_at)->format('d M Y') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <p class="text-xl font-semibold text-gray-700 flex items-center">
                                Price Rp {{ number_format($event->price, 0, ',', '.') }}
                            </p>
                            <p class="text-sm font-medium text-gray-700 flex items-center">
                                Quota {{ $event->quota }} people
                            </p>
                            <p class="text-sm font-medium text-gray-700 flex items-center">
                                Min Age {{ $event->min_age }} Y.O
                            </p>
                        </div>

                        @if (auth()->user()->role == 'user')
                            <form action="{{ route('registrants.register', $event->id) }}" class="mt-5"
                                method="POST">
                                @csrf
                                <button
                                    class="bg-violet-600 hover:bg-violet-800 text-violet-100 px-4 py-2 rounded">Register
                                    now!</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
