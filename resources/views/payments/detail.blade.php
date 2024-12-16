<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Payment by ' . $payment->registrant->user->name) }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Last update at ' . $payment->updated_at->diffForHumans() . ' | Create on ' . $payment->created_at) }}
                    </p>
                    <div class="mt-2">
                        <p><span class="font-semibold">Payment amount to be paid:</span>
                            <span
                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                Rp {{ number_format($payment->registrant->event->price, 0, ',', '.') }}
                            </span>
                        </p>
                        <p>
                            <span class="font-semibold">Event Name:</span> {{ $payment->registrant->event->title }}
                            | On {{ \Carbon\Carbon::parse($payment->registrant->event->name)->format('d M Y') }}
                        </p>
                    </div>
                </header>

                @if (auth()->user()->role == 'user')
                    <form action="{{ route('payments.update', $payment->id) }}" method="POST"
                        enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Amount Input -->
                        <div>
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" type="number" :value="old('amount', $payment->amount)"
                                class="mt-1 block w-full" autofocus autocomplete="amount" />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>

                        <div>
                            <x-input-label for="bank_name" :value="__('Bank Account Name')" />
                            <x-text-input id="bank_name" name="bank_name" type="text" :value="old('bank_name', $payment->bank_name)"
                                class="mt-1 block w-full" autofocus autocomplete="bank_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                        </div>

                        <div>
                            <x-input-label for="bank_beneficiary" :value="__('Bank Name')" />
                            <x-text-input id="bank_beneficiary" name="bank_beneficiary" type="text" :value="old('bank_beneficiary', $payment->bank_beneficiary)"
                                class="mt-1 block w-full" autofocus autocomplete="bank_beneficiary" />
                            <x-input-error class="mt-2" :messages="$errors->get('bank_beneficiary')" />
                        </div>

                        <div class="flex justify-between gap-5">
                            <div class="w-1/2">
                                <x-input-label for="proof_image" :value="__('Proof Image')" />
                                <x-text-input id="proof_image" name="proof_image" type="file"
                                    class="mt-1 p-4 block w-full" :value="old('proof_image', $payment->proof_image)" />
                                <x-input-error class="mt-2" :messages="$errors->get('proof_image')" />
                            </div>
                            <div class="w-1/2 p-5 shadow-lg rounded-lg">
                                <img src="{{ Storage::url($payment->proof_image) }}" alt=""
                                    class="w-full rounded-lg">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                @endif

                @if (auth()->user()->role == 'admin')
                    <div class="mt-6 flex gap-5">
                        <div class="w-1/2">
                            <h3 class="text-lg font-medium text-gray-900">Payment Detail</h3>
                            <div class="mt-2 flex flex-col gap-4 border p-5 rounded-lg">
                                <div>
                                    <h3 class="font-bold text-lg">Amount</h3>
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Bank Account Name</h3>
                                    <p class="text-lg uppercase">{{ $payment->bank_name }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg">Bank Name</h3>
                                    <p class="text-lg uppercase">{{ $payment->bank_beneficiary }}</p>
                                </div>
                            </div>
                            <div class="flex gap-5">
                                <form action="{{ route('payments.approved', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('patch')

                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-700 text-white text-lg font-bold py-1 px-2 rounded mt-5">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('payments.rejected', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('patch')

                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white text-lg font-bold py-1 px-2 rounded mt-5">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <h3 class="text-lg font-medium text-gray-900">Payment Proof</h3>
                            <div class="mt-2">
                                <img src="{{ Storage::url($payment->proof_image) }}" alt=""
                                    class="w-full rounded-lg">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
