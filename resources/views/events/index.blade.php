<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol untuk menambahkan event baru -->
            @if(Auth::user()->role == 'admin')
            <div class="mb-6 flex justify-end">
                <a href="{{ route('events.create') }}" class="bg-yellow-600 hover:bg-yellow-800 text-white font-semibold py-3 px-6 rounded-md shadow-lg transition duration-300 transform hover:scale-105">
                    Add Event
                </a>
            </div>
            @endif

            @if (session('success') || session('error'))
                <div class="w-full p-5 {{ session('success') ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-lg mb-5">
                    {{ session('success') ?? session('error') }}
                </div>
            @endif

            <!-- Tabel daftar event -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full table-auto text-left">
                    <thead>
                        <tr class="bg-orange-600 text-black">
                            <th class="px-4 py-3 text-sm font-semibold ">No</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Image</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Title</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Location</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Price</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Category</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Quota</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Status</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Start At</th>
                            <th class="px-4 py-3 text-sm font-semibold ">Registrant</th>
                            @if(Auth::user()->role == 'admin')
                            <th class="px-4 py-3 text-sm font-semibold ">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="transition duration-200 hover:bg-gray-50 border-b border-gray-400">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <img src="{{ Storage::url($event->featured_image) }}"
                                         alt="{{ $event->title }}"
                                         class="h-20 w-20 object-cover rounded-lg shadow-md">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->location }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->price }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->category->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->quota }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->status }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->start_event_at }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $event->registrant_count }}</td>
                                <td class="px-4 py-3 text-sm space-x-2">
                                    <a href="{{ route('events.show', $event->id) }}" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                        View
                                    </a>
                                    @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('events.edit', $event->id) }}" class="bg-green-600 hover:bg-green-800 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                        Edit
                                    </a>
                                    <form class="inline" action="{{ route('events.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                            Delete
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>