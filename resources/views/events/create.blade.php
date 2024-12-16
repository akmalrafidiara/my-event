<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-1xl text-gray-800 leading-tight">
            {{ __('Create New event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-8 space-y-4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Create New event') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Creating new upcoming event.") }}
                    </p>
                </header>

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf

                    <!-- Title Input -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" :value="old('title')"
                            class="mt-1 block w-full" autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    {{-- Description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 
                             focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Location --}}
                    <div>
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" :value="old('location')"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    {{-- Start Event At --}}
                    <div>
                        <x-input-label for="start_event_at" :value="__('Start Event At')" />
                        <x-text-input id="start_event_at" name="start_event_at" type="date"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('start_event_at')" />
                    </div>

                    {{-- End Event At --}}
                    <div>
                        <x-input-label for="end_event_at" :value="__('End Event At')" />
                        <x-text-input id="end_event_at" name="end_event_at" type="date"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('end_event_at')" />
                    </div>

                    {{-- Min Age --}}
                    <div>
                        <x-input-label for="min_age" :value="__('Min Age')" />
                        <x-text-input id="min_age" name="min_age" type="number" :value="old('min_age')"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('min_age')" />
                    </div>

                    {{-- Price --}}
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" :value="old('price')"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    {{-- Quota --}}
                    <div>
                        <x-input-label for="quota" :value="__('Quota')" />
                        <x-text-input id="quota" name="quota" type="number" :value="old('quota')"
                            class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('quota')" />
                    </div>

                    {{-- Featured Image --}}
                    <div>
                        <x-input-label for="featured_image" :value="__('Featured Image')" />
                        <x-text-input id="featured_image" name="featured_image" type="file" class="mt-1 p-4 block w-full" :value="old('featured_image')" />
                        <x-input-error class="mt-2" :messages="$errors->get('featured_image')" />
                    </div>

                    {{-- Category --}}
                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 
                             focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>