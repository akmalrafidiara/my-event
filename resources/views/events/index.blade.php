<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->role == 'admin')
                <div class="mb-6">
                    <a href="{{ route('events.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Event
                    </a>
                </div>
            @endif

            @if (session('success') || session('error'))
                <div
                    class="w-full p-5 {{ session('success') ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-lg mb-5">
                    {{ session('success') }}
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel daftar event -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="table-auto text-dark w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Image</th>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Location</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Quota</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Start At</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">
                                    <img src="{{ Storage::url($event->featured_image) }}" alt="{{ $event->title }}"
                                        class="h-20 w-auto object-cover">
                                </td>
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">{{ $event->location }}</td>
                                <td class="px-4 py-2">{{ $event->price }}</td>
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">{{ $event->category->name }}</td>
                                <td class="px-4 py-2">{{ $event->status }}</td>
                                <td class="px-4 py-2">{{ $event->start_event_at }}</td>
                                <td class="px-4 py-2 flex gap-1 mt-5">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            Edit
                                        </a>
                                        <form class="inline" action="{{ route('events.destroy', $event->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-1 px-2 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('events.show', $event->id) }}"
                                        class="bg-sky-500 hover:bg-sky-700 text-white text-xs font-bold py-1 px-2 rounded">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
