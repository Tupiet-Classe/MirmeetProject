@extends('layouts.template')
@section('content')
    <h1>Resultados búsqueda</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->username }}</li>
        @endforeach
    </ul>
@endsection
