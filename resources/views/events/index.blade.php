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
            <div style="background-color: #ffffff; border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #ea580c; color: white;">
                            <th style="padding: 20px;">No</th>
                            <th style="padding: 16px;">Image</th>
                            <th style="padding: 16px;">Title</th>
                            <th style="padding: 16px;">Location</th>
                            <th style="padding: 16px;">Price</th>
                            <th style="padding: 16px;">Category</th>
                            <th style="padding: 16px;">Quota</th>
                            <th style="padding: 16px;">Status</th>
                            <th style="padding: 20px;">Start At</th>
                            <th style="padding: 16px;">Registrant</th>
                            <th style="padding: 16px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr style="border-bottom: 1px solid #e5e7eb; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#f3f4f6';" onmouseout="this.style.backgroundColor='white';">
                                <td style="padding: 16px; text-align: center;">{{ $loop->iteration }}</td>
                                <td style="padding: 16px; text-align: center;">
                                    <!-- Image size is consistent for both user and admin -->
                                    <img src="{{ Storage::url($event->featured_image) }}"
                                         alt="{{ $event->title }}"
                                         style="height: 80px; width: 100px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                </td>
                                <td style="padding: 16px;">{{ $event->title }}</td>
                                <td style="padding: 16px;">{{ $event->location }}</td>
                                <td style="padding: 16px;">{{ $event->price }}</td>
                                <td style="padding: 16px;">{{ $event->category->name }}</td>
                                <td style="padding: 16px; text-align: center;">{{ $event->quota }}</td>
                                <td style="padding: 16px; text-align: center;">
                                    <span style="display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; color: white; background-color: {{ $event->status == 'active' ? '#16a34a' : '#dc2626' }};">
                                        {{ ucfirst($event->status) }}
                                    </span>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>