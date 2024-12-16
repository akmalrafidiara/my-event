<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success') || session('error'))
                <div
                    class="w-full p-5 {{ session('success') ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-lg mb-5">
                    {{ session('success') }}
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="table-auto text-dark w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Event Title</th>
                            <th class="px-4 py-2">Total Payment</th>
                            <th class="px-4 py-2">Last Updated At</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 capitalize">
                                    <span
                                   class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $payment->status }}</span>
                                </td>
                                <td class="px-4 py-2">
                                    {{ $payment->registrant->user->id }} - {{ $payment->registrant->user->name }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('events.show', $payment->registrant->event->id) }}"
                                        class="text-indigo-700">
                                        {{ $payment->registrant->event->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-2">
                                    Rp {{ number_format($payment->registrant->event->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($payment->updated_at)->format('d M Y H:i') }}
                                </td>
                                
                                <td class="px-4 py-2 flex gap-1">
                                    <a href="{{ route('payments.detail', $payment->id) }}"
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