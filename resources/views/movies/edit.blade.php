<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    {{-- end of Validation Errors --}}

                    <form method="POST" action="{{ route('movies.update', $movie->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="title" :value="__('Title')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="$movie->title" required autofocus />
                        </div>
                        {{-- end of title --}}

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />

                            <textarea id="description" class="block mt-1 w-full rounded border-gray-300" name="description">
                                {{ $movie->description }}
                            </textarea>
                        </div>
                        {{-- end of description --}}

                        <div class="mt-4">
                            <x-label for="image" :value="__('Image')" />

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image"
                                :value="$movie->image" />
                        </div>
                        {{-- end of image --}}

                        <div class="mt-4">
                            <x-label for="categories" :value="__('Categories')" />

                            @php
                                $old_cat_ids = Arr::pluck($movie->categories, 'id');
                            @endphp     

                            <div class="flex flex-row items-center gap-4">
                                @foreach ($categories as $category)
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-gray-800 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        id="{{ $category->id }}" name="categories_ids[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, $old_cat_ids) ? 'checked' : '' }}>
                                    <label for="{{ $category->id }}">{{ $category->title }}</label>
                                @endforeach
                            </div>
                        </div>
                        {{-- end of categories --}}

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Add') }}
                            </x-button>
                        </div>
                    </form>
                    {{-- end of the form --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
