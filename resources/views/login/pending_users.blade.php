<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Registration') }}
        </h2>
    </x-slot>

    @vite('resources/css/app.css')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div id="margin_table">

                        <div class="flex justify-between">
                            <form class="flex" action="{{ route('pending.search') }}" method="GET">
                                <label for="searchPending" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search-pending" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Buscador...">
                                    <button type="submit" class="text-white absolute right-2.5 bottom-1 bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1">
                                        Buscar
                                    </button>
                                </div>
                            </form>

                            @can('dashboard.validate.users.restore')
                                <div class="mt-1">
                                    <a href="{{ route('denied.users') }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                        Denied Users
                                    </a>
                                </div>

                            @endcan
                        </div>

                        <div class="relative shadow-md rounded-lg">
                            <table class="mt-4 w-full text-sm text-center text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Options
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingUsers as $user)
                                        <tr class="border-b bg-white hover:bg-gray-50">
                                            <th scope="row" class="break-all px-6 py-4 font-medium text-gray-900">
                                                {{ $user->name }}
                                            </th>
                                            <td class="break-all px-6 py-4 font-medium text-gray-900">
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                <div class="inline-flex">
                                                    <a href="{{ route('allow', $user->id) }}"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-l-md">
                                                        Allow
                                                    </a>
                                                    <a href="{{ route('deny', $user->id) }}"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-r-md">
                                                        Deny
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="ml-2 d-flex justify-content-center mt-3">
                                {{ $pendingUsers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</x-app-layout>
