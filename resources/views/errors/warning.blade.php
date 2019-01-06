@extends('layouts.app')

@section('content')

    <h1>Warning</h1>
    <p>{{ $message }}</p>
    <a href="{{ route('home') }}">Home</a>

@endsection