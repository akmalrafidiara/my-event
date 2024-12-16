<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white shadow-xl sm:rounded-lg">
                <header>
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ __('Edit Event') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Editing " . $event->title . " event.") }}
                    </p>
                </header>

                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    {{-- Status --}}
                    @php
                        $statuses = ['upcoming', 'open', 'ongoing', 'done'];
                    @endphp
                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status" class="mt-1 block w-full p-3 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
                            <option value="" disabled selected>Select Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ old('status', $event->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <!-- Title Input -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" :value="old('title', $event->title)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    {{-- Description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">{{ old('description', $event->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Location --}}
                    <div>
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" :value="old('location', $event->location)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    {{-- Start Event At --}}
                    <div>
                        <x-input-label for="start_event_at" :value="__('Start Event At')" />
                        <x-text-input id="start_event_at" name="start_event_at" type="date" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" :value="old('start_event_at', $event->start_event_at)" />
                        <x-input-error class="mt-2" :messages="$errors->get('start_event_at')" />
                    </div>

                    {{-- End Event At --}}
                    <div>
                        <x-input-label for="end_event_at" :value="__('End Event At')" />
                        <x-text-input id="end_event_at" name="end_event_at" type="date" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" :value="old('end_event_at', $event->end_event_at)" />
                        <x-input-error class="mt-2" :messages="$errors->get('end_event_at')" />
                    </div>

                    {{-- Min Age --}}
                    <div>
                        <x-input-label for="min_age" :value="__('Min Age')" />
                        <x-text-input id="min_age" name="min_age" type="number" :value="old('min_age', $event->min_age)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" />
                        <x-input-error class="mt-2" :messages="$errors->get('min_age')" />
                    </div>

                    {{-- Price --}}
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" :value="old('price', $event->price)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    {{-- Quota --}}
                    <div>
                        <x-input-label for="quota" :value="__('Quota')" />
                        <x-text-input id="quota" name="quota" type="number" :value="old('quota', $event->quota)" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" />
                        <x-input-error class="mt-2" :messages="$errors->get('quota')" />
                    </div>

                    {{-- Featured Image --}}
                    <div>
                        <x-input-label for="featured_image" :value="__('Featured Image')" />
                        <div class="my-4">
                            <img src="{{ $event->featured_image ? Storage::url($event->featured_image) : 'https://static.vecteezy.com/system/resources/previews/005/129/844/non_2x/profile-event-icon-isolated-on-white-background-eps10-free-vector.jpg' }}"
                                alt="{{ $event->title }}" class="rounded-md h-32 w-32 object-cover mx-auto shadow-md transition duration-300 ease-in-out">
                        </div>
                        <x-text-input id="featured_image" name="featured_image" type="file" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" :value="old('featured_image', $event->featured_image)" />
                        <x-input-error class="mt-2" :messages="$errors->get('featured_image')" />
                    </div>

                    {{-- Category --}}
                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="mt-1 block w-full p-3 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category->id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center mt-8">
                        <x-primary-button class="py-3 px-8 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none transition-all duration-300 ease-in-out">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>