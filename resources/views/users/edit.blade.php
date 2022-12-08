<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    {{-- end of Validation Errors --}}

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="$user->name" required autofocus />
                        </div>
                        {{-- end of name --}}

                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="$user->email" required />
                        </div>
                        {{-- end of email --}}

                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>
                        {{-- end of password --}}

                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>
                        {{-- end of password confirmation --}}

                        <div class="mt-4">
                            <x-label for="birthdate" :value="__('Birth date')" />

                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="$user->birthdate" />
                        </div>
                        {{-- end of birthdate --}}
                        @if ($user->getRoles()[0] != 'super_admin')
                            <div class="mt-4">
                                <x-label for="role" :value="__('Role')" />
                                <select id="role" class="block mt-1 w-full rounded border-gray-300" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->getRoles()[0] == $role->name ? 'selected' : '' }}>
                                            {{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- end of roles --}}

                            <div class="mt-4">
                                <x-label for="permissions" :value="__('Permissions')" />
                                @php
                                    $models = ['users', 'categories', 'movies'];
                                    $permissions = ['create', 'read', 'update', 'delete'];
                                @endphp
                                @foreach ($models as $model)
                                    <div class="my-4">
                                        <div>{{ $model }}:</div>
                                        <div class="flex justify-between">
                                            @foreach ($permissions as $permission)
                                                <div>
                                                    <input type="checkbox"
                                                        class="rounded border-gray-300 text-gray-800 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                        id="{{ $model . '-' . $permission }}" name="permissions[]"
                                                        value="{{ $model . '-' . $permission }}"
                                                        {{ $user->hasPermission($model . '-' . $permission) ? 'checked' : '' }}>
                                                    <label
                                                        for="{{ $model . '-' . $permission }}">{{ $permission . ' ' . $model }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- end of permissions --}}
                        @endif

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
