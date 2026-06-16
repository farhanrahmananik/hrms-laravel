@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white border rounded-3 p-4 shadow-sm">
        <h1 class="h3 mb-3">Dashboard</h1>
        <p class="mb-0">Welcome, {{ auth()->user()->name }}.</p>
    </div>
@endsection
