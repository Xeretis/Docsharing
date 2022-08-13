@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('spaces.enter') }}">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex flex-col items-center w-3/4 md:w-1/2 lg:w-1/4">
                <h1 class="text-2xl font-semibold">Join space</h1>
                @csrf
                <label for="code" class="self-start mt-3">Code</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}" class="w-full input @error('code') border-red-500 @enderror">
                @error('code')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror

                <div class="flex flex-row items-start justify-between w-full mt-3">
                    <a href="{{ route('spaces.index') }}"class="primary-button">Back</a>
                    <button type="submit" class="primary-button">Join</button>
                </div>
            </div>
        </div>
    </form>
@endsection
