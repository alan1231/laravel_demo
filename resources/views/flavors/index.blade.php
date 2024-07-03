@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Flavors List</h1>
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 mb-4">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 mb-4">
        {{ session('error') }}
    </div>
@endif
<ul class="list-disc pl-5">
    @foreach ($flavors as $flavor)
        <div class="mb-4">
            <h2 class="text-xl font-semibold">{{ $flavor->name }}</h2>
            <p>{{ $flavor->description }}</p>
            <p>{{ $flavor->price }}</p>
            @if ($flavor->image_path)
                <img src="{{ asset('storage/' . $flavor->image_path) }}" alt="{{ $flavor->name }}" class="mt-2 mb-2">
            @else
                <p>No image available</p>
                <a href="{{ route('flavors.showUploadImageForm', $flavor->id) }}" class="text-blue-500 underline">Upload
                    Image</a>
            @endif

            <!-- 添加刪除按鈕 -->
            <form action="{{ route('flavors.destroy', $flavor->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this flavor?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 underline">Delete</button>
            </form>
        </div>
    @endforeach
</ul>
<a href="{{ route('flavors.create') }}" class="text-blue-500 underline">Add New Flavor</a>
@endsection