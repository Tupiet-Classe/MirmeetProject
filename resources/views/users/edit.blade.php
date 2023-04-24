<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    @vite('resources/css/app.css')

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('users.update', $user->id) }}" class="px-4 py-5 sm:p-6">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="col-md-6">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="username" value="{{ old('username', $user->username) }}" required
                                autocomplete="username">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                        <div class="col-md-6">
                            <input id="dni" type="text"
                                class="form-control @error('dni') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="dni" value="{{ old('dni', $user->dni) }}" required autocomplete="dni">
                            @error('dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <div class="col-md-6">
                            <input id="phone" type="text"
                                class="form-control @error('phone') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                        <div class="col-md-6">
                            <input id="birthdate" type="date"
                                class="form-control @error('birthdate') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required
                                autocomplete="birthdate">
                            @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <span class="block text-sm font-medium text-gray-700 mb-2">Role</span>
                        <div class="flex flex-row items-center">
                            <label for="role_user" class="mr-4">
                                <input type="radio" id="role_admin" name="role" value="admin"
                                    @if ($user->role == 'admin') checked @endif
                                    class="focus:ring-blue-600 h-4 w-4 text-blue-600 border-gray-300">
                                <span class="ml-2 text-sm font-medium text-gray-700">Admin</span>
                            </label>
                            <label for="role_admin" class="mr-4">
                                <input type="radio" id="role_moderator" name="role" value="moderator"
                                    @if ($user->role == 'moderator') checked @endif
                                    class="focus:ring-blue-600 h-4 w-4 text-blue-600 border-gray-300">
                                <span class="ml-2 text-sm font-medium text-gray-700">Moderator</span>
                            </label>
                            <label for="role_admin" class="mr-4">
                                <input type="radio" id="role_client" name="role" value="client"
                                    @if ($user->role == 'client') checked @endif
                                    class="focus:ring-blue-600 h-4 w-4 text-blue-600 border-gray-300">
                                <span class="ml-2 text-sm font-medium text-gray-700">Client</span>
                            </label>
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="password" autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password"
                                class="form-control mt-1 focus:ring-blue-600 focus:border-blue-600 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">{{ __('Update') }}
                            </button>
                            <a href="{{ route('users.index') }}"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</x-app-layout>
