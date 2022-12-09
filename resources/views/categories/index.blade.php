<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">

                        @permission('categories-create')
                            <a class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded mx-5 text-center"
                                href="{{ route('categories.create') }}">add category</a>
                        @endpermission
                        {{-- end of adding category --}}

                        <div class="container px-5 py-16 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                @foreach ($categories as $category)
                                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                                        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                            <div class="flex flex-grow justify-between">
                                                <div class="">

                                                    <h2 class="text-gray-900 title-font font-medium">
                                                        {{ $category->title }}
                                                    </h2>
                                                    {{-- end of title --}}

                                                    <p class="text-gray-500">
                                                        {{ $category->movies_count }} Movies
                                                    </p>
                                                    {{-- end of moviesCount --}}
                                                </div>
                                                {{-- end of categories data --}}

                                                <div class="flex flex-col">

                                                    @permission('categories-update')
                                                        <a class="text-white bg-amber-500 border-0 py-2 px-6 focus:outline-none hover:bg-amber-600 rounded mb-1 text-center"
                                                            href="{{ route('categories.edit', $category->id) }}">edit</a>
                                                    @endpermission
                                                    {{-- end of edit category --}}

                                                    @permission('categories-delete')
                                                        <form method="POST" class="d-inline"
                                                            action="{{ route('categories.destroy', $category->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white bg-red-500
                                                            border-0 py-2 px-6 focus:outline-none hover:bg-red-600
                                                            rounded text-center">
                                                                delete</button>
                                                        </form>
                                                    @endpermission
                                                    {{-- end of delete categories --}}

                                                </div>
                                                {{-- end of actions --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of the category card --}}
                                @endforeach

                            </div>
                        </div>
                    </section>
                    {{-- end of the section --}}
                    {{ $categories->appends(request()->query())->links() }}
                    {{-- end of pagination --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
