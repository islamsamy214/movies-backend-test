<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    {{-- end of Validation Errors --}}

                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="title" :value="__('Title')" />

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="$category->title" required autofocus />
                        </div>
                        {{-- end of title --}}

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
