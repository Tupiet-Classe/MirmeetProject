@extends('layouts.template')

@section('content')
    <ul>
        @foreach ($users as $user)
            <a href="/user/{{ $user->username }}">
                <div class="bg-gray-200 p-4 rounded-md flex items-center">
                    <img src="{{ $user->avatar }}" alt="Profile image" class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold">{{ $user->username }}</h3>
                        <p class="text-gray-700">{{ $user->email }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </ul>
@endsection
