@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome to Flavor App</h1>
    <a href="{{ route('flavors.index') }}" class="text-blue-500 underline">View Flavors</a>
@endsection