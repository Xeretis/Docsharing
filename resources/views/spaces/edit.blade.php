@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('spaces.update', ['space' => $space->hash]) }}">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex flex-col items-center w-3/4 md:w-1/2 lg:w-1/4">
                <h1 class="text-2xl font-semibold">Edit space</h1>
                @method('PUT')
                @csrf
                <label for="name" class="self-start mt-3">Name</label>
                <input type="text" name="name" id="name" value="{{ $space->name }}" class="w-full input @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <label for="description" class="self-start mt-3">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full input @error('description') border-red-500 @enderror">{{ $space->description }}</textarea>
                @error('description')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-between w-full mt-3">
                    <label for="joinable_with_hash" class="mr-2">Joinable with code</label>
                    <input type="checkbox" name="joinable_with_hash" id="joinable_with_hash" class="checkbox" {{ $space->joinable_with_hash ? 'checked' : '' }}>
                </div>
                @error('joinable_with_hash')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex flex-row items-start justify-between w-full mt-3">
                    <a href="{{ route('spaces.index') }}"class="primary-button">Back</a>
                    <button type="submit" class="primary-button">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
