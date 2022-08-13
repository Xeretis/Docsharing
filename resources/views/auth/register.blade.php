@extends('layouts.app')

@section('content')
    <form method="POST" action="/register">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex flex-col items-center w-3/4 md:w-1/2 lg:w-1/4">
                <h1 class="text-2xl font-semibold">Register</h1>
                @csrf
                <label for="name" class="self-start mt-3">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full input @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <label for="email" class="self-start mt-3">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full input @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <label for="password" class="self-start mt-3">Password</label>
                <input type="password" name="password" id="password" class="w-full input @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <label for="password_confirmation" class="self-start mt-3">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full input @error('password_confirmation') border-red-500 @enderror">
                @error('password_confirmation')
                    <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit" class="self-start mt-3 primary-button">Register</button>
                <p class="mt-3">Already have an account? <a href="/login" class="anchor">Log in</a></p>
            </div>
        </div>
    </form>
@endsection
