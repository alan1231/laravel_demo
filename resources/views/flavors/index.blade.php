@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Flavors List</h1>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    <ul class="list-disc pl-5">
        @foreach ($flavors as $flavor)
            <li class="mb-2">
                {{ $flavor->name }} - {{ $flavor->description }}
                <form action="{{ route('flavors.destroy', $flavor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 underline">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('flavors.create') }}" class="text-blue-500 underline">Add New Flavor</a>
@endsection