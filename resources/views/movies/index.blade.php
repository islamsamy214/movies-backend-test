<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">

                        @permission('movies-create')
                            <a class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded mx-5 text-center"
                                href="{{ route('movies.create') }}">add movie</a>
                        @endpermission
                        {{-- end of adding movie --}}

                        <div class="container px-5 py-16 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                @foreach ($movies as $movie)
                                    <div class="flex flex-col p-2 lg:w-1/3 md:w-1/2 w-full">
                                        <div
                                            class="h-full flex flex-col items-center border-gray-200 border p-4 rounded-lg">
                                            <div>
                                                <h2 class="text-gray-900 title-font font-medium">
                                                    {{ $movie->title }}
                                                </h2>
                                                {{-- end of title --}}
                                            </div>
                                            <div>
                                                <img src="{{ asset($movie->image_path) }}"
                                                    class="w-full h-full rounded-lg " alt="">
                                            </div>
                                            <div class="flex flex-row justify-between w-full">
                                                <div class="w-full">
                                                    <p class="text-gray-500">
                                                        @foreach ($movie->categories as $category)
                                                            {{ $category->title . ', ' }}
                                                        @endforeach
                                                    </p>
                                                    {{-- end of categories --}}
                                                    <form method="GET"
                                                        action="{{ route('movies.rate', $movie->id) }}">
                                                        <div class="flex">
                                                            <x-label for="rate" :value="__('Rate')" />
                                                            <p>: {{ $movie->rate }} Stars</p>
                                                        </div>
                                                        <div class="flex">
                                                            <select id="rate" class="rounded border-gray-300"
                                                                name="rate" :value="old('rate')">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i . ' star' }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            <x-button class="ml-1">
                                                                {{ __('Submit') }}
                                                            </x-button>
                                                        </div>
                                                    </form>
                                                    {{-- end of rate --}}
                                                </div>
                                                {{-- end of movies data --}}

                                                <div class="flex flex-col">

                                                    @permission('movies-update')
                                                        <a class="text-white bg-amber-500 border-0 py-2 px-6 focus:outline-none hover:bg-amber-600 rounded mb-1 text-center"
                                                            href="{{ route('movies.edit', $movie->id) }}">edit</a>
                                                    @endpermission
                                                    {{-- end of edit movie --}}

                                                    @permission('movies-delete')
                                                        <form method="POST" class="d-inline"
                                                            action="{{ route('movies.destroy', $movie->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white bg-red-500
                                                            border-0 py-2 px-6 focus:outline-none hover:bg-red-600
                                                            rounded text-center">
                                                                delete</button>
                                                        </form>
                                                    @endpermission
                                                    {{-- end of delete movies --}}

                                                </div>
                                                {{-- end of actions --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of the movie card --}}
                                @endforeach

                            </div>
                        </div>
                    </section>
                    {{-- end of the section --}}
                    {{ $movies->appends(request()->query())->links() }}
                    {{-- end of pagination --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
