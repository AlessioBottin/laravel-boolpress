@extends('layouts.dashboard')

@section('content')
    <h1>Ciao {{ $user->name }}, benvenuto nell'area per gli admin</h1>

    @if ($userInfo)
        <div>Telefono: {{ $userInfo->phone }}</div>
        <div>Indirizzo: {{ $userInfo->address }}</div>
    @endif
@endsection