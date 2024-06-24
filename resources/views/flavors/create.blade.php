@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add New Flavor</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('flavors.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name:</label>
            <input type="text" name="name" id="name" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description:</label>
            <textarea name="description" id="description" class="border border-gray-300 rounded p-2 w-full"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Flavor</button>
    </form>
@endsection