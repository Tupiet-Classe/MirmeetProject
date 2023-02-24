<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Denied Users') }}
        </h2>
    </x-slot>

    @vite('resources/css/app.css')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div id="margin_table" class="relative overflow-x-auto shadow-md rounded-lg">
                        <table class="w-full text-sm text-center text-gray-500">
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
                                @foreach ($deniedUsers as $user)
                                    <tr class="border-b bg-white hover:bg-gray-50">
                                        <th scope="row" class="break-all px-6 py-4 font-medium text-gray-900">
                                            {{ $user->name }}
                                        </th>
                                        <td class="break-all px-6 py-4 font-medium text-gray-900">
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            <div class="inline-flex">
                                                <a href="{{ route('restore', $user->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded-full">
                                                    Restore
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="ml-2 d-flex justify-content-center mt-3">
                            {{ $deniedUsers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
</x-app-layout>
