<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>
    <div style="padding: 48px 0; background-color: #f9fafb;">
        <div style="max-width: 1120px; margin: 0 auto; padding: 0 24px;">
            <!-- Tombol untuk menambahkan event baru -->
            @if(Auth::user()->role == 'admin')
            <div style="margin-bottom: 24px; display: flex; justify-content: flex-end;">
                <a href="{{ route('events.create') }}" 
                   style="background-color: #d97706; color: white; font-weight: 600; padding: 12px 24px; border-radius: 8px; text-decoration: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s, background-color 0.3s;"
                   onmouseover="this.style.backgroundColor='#b45309'; this.style.transform='scale(1.05)';" 
                   onmouseout="this.style.backgroundColor='#d97706'; this.style.transform='scale(1)';">
                    Add Event
                </a>
            </div>
            @endif

            @if (session('success') || session('error'))
                <div style="width: 100%; padding: 16px; border-radius: 8px; margin-bottom: 20px; color: white; font-weight: 600; {{ session('success') ? 'background-color: #16a34a;' : 'background-color: #dc2626;' }}">
                    {{ session('success') ?? session('error') }}
                </div>
            @endif

            <!-- Tabel daftar event -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                {{-- <table class="table-auto text-dark w-full text-left">
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
                                <td style="padding: 16px; text-align: center;">{{ $event->start_event_at }}</td>
                                <td style="padding: 16px; text-align: center;">{{ $event->registrant_count }}</td>
                                <td style="padding: 16px; text-align: center;">
                                    <div style="display: flex; flex-direction: column; gap: 10px; align-items: center;">
                                        <a href="{{ route('events.show', $event->id) }}"
                                           style="background-color: #2563eb; color: white; padding: 12px 24px; width: 80px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background-color 0.3s; text-align: center;"
                                           onmouseover="this.style.backgroundColor='#1d4ed8';" onmouseout="this.style.backgroundColor='#2563eb';">
                                            View
                                        </a>
                                        @if(Auth::user()->role == 'admin')
                                        <a href="{{ route('events.edit', $event->id) }}"
                                           style="background-color: #22c55e; color: white; padding: 12px 24px; width: 80px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background-color 0.3s; text-align: center;"
                                           onmouseover="this.style.backgroundColor='#16a34a';" onmouseout="this.style.backgroundColor='#22c55e';">
                                            Edit
                                        </a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="margin: 0; display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="background-color: #dc2626; color: white; padding: 12px 24px; width: 80px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.3s; text-align: center;"
                                                    onmouseover="this.style.backgroundColor='#b91c1c';" onmouseout="this.style.backgroundColor='#dc2626';">
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($events as $event)
                        @endforeach
                    </tbody>
                </table> --}} 
                <div class="w-full flex flex-wrap justify-evenly">
                @foreach ($events as $event)
                <div class="event" class="w-full bg-[#0000] p-10">
                    <img src="{{ Storage::url($event->featured_image) }}" alt="{{ $event->title }}"
                    class="h-20 w-auto object-cover" style="height: 7cm; width: 7cm; border-radius: 20px;" onclick="window.location.href = '{{ route('events.show', $event->id) }}'">
                    <h1 class="text-3xl font-bold">{{ $event->title }}</h1>
                    <small>At {{ $event->location }}</small>
                    <div class="flex justify-evenly m-5">
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
                </div>
                @else
                </div>
                @endif
                </div>
                @endforeach
               </div>
        </div>
    </div>
</x-app-layout>