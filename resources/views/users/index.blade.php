<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <a class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded mx-5 text-center"
                            href="{{ route('users.create') }}">add user</a>
                        {{-- end of adding user --}}
                        <div class="container px-5 py-16 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                @foreach ($users as $user)
                                    <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                                        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                                            <div class="flex flex-grow justify-between">
                                                <div class="">
                                                    <h2 class="text-gray-900 title-font font-medium">{{ $user->name }}
                                                    </h2>
                                                    {{-- end of name --}}
                                                    @foreach ($user->getRoles() as $role)
                                                        <p class="text-gray-500">
                                                            {{ $role }}
                                                        </p>
                                                    @endforeach
                                                    {{-- end of roles --}}
                                                </div>
                                                {{-- end of personal data --}}
                                                <div class="flex flex-col">
                                                    <a class="text-white bg-amber-500 border-0 py-2 px-6 focus:outline-none hover:bg-amber-600 rounded mb-1 text-center"
                                                        href="{{ route('users.edit', $user->id) }}">edit</a>

                                                    <form method="POST" class="d-inline"
                                                        action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-red-500
                                                            border-0 py-2 px-6 focus:outline-none hover:bg-red-600
                                                            rounded text-center">
                                                            delete</button>
                                                    </form>
                                                </div>
                                                {{-- end of actions --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of the user card --}}
                                @endforeach

                            </div>
                        </div>
                    </section>
                    {{-- end of the section --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
