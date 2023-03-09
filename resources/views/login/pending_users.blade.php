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
                        @can('dashboard.validate.users.restore')
                            <a href="{{ route('denied.users') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Denied Users
                            </a>
                        @endcan
                        <div class="relative shadow-md rounded-lg">
                            <table class="mt-4 w-full text-sm text-left text-gray-500">
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
