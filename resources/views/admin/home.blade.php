@extends('layouts.dashboard')

@section('content')
    <h1>Ciao {{ Auth::user()->name }}, benvenuto nell'area per gli admin</h1>
@endsection