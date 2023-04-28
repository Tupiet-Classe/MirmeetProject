@extends('layouts.template')

@section('content')
    <ul>
        @if ($message)
            <p class="mt-3 text-red-600">{{ $message }}</p>
        @else
            @foreach ($users as $user)
                <a href="/perfil/{{ $user->username }}">
                    <div class="bg-gray-300 mt-3 p-4 rounded-md flex items-center">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('https://icons-for-free.com/download-icon-user+icon-1320190636314922883_512.png') }}"
                            alt="Profile image" class="w-10 h-10 rounded-full mr-4">
                        {{-- <img src="{{ $user->avatar }}" alt="Profile image" class="w-10 h-10 rounded-full mr-4"> --}}
                        <div>
                            <h3 class="font-bold">{{ $user->name }}</h3>
                            <p class="text-gray-700">@ {{ $user->username }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </ul>
@endsection
