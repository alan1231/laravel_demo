@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Upload Image for {{ $flavor->name }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('flavors.uploadImage', $flavor->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image:</label>
            <input type="file" name="image" id="image" class="border border-gray-300 rounded p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Upload Image</button>
    </form>
@endsection