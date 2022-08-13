@extends('layouts.app')

@section('content')
    <form method="POST" action="/login">
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex flex-col items-center w-3/4 md:w-1/2 lg:w-1/4">
                <h1 class="text-2xl font-semibold">Login</h1>
                @csrf
                <label for="email" class="self-start mt-3">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full input @error('email') border-red-500 @enderror">
                @error('email')
                <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <label for="password" class="self-start mt-3">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full input @error('password') border-red-500 @enderror">
                @error('password')
                <p class="self-start text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex flex-row items-start justify-between w-full mt-3">
                    <button type="submit" class="primary-button">Log in</button>
                    <div class="">
                        <label for="remember" class="m-2">Remember me</label>
                        <input type="checkbox" name="remember" id="remember"
                               {{ old('remember') == 'on' ? 'checked' : '' }} class="checkbox">
                    </div>
                </div>
                <p class="mt-3">Don't have an account yet? <a href="/register" class="anchor">Register</a></p>
            </div>
        </div>
    </form>
@endsection
