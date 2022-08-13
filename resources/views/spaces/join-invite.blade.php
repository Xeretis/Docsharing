@extends('layouts.app')

@section('content')
    <form method="POST"
          action="{{ Illuminate\Support\Facades\URL::signedRoute('spaces.enter-invite', ['space' => $space->hash]) }}">
        @csrf
        <div class="flex items-center justify-center w-full h-screen">
            <div class="flex flex-col items-center w-3/4 text-center md:w-1/2 lg:w-1/4">
                <h1 class="text-2xl font-semibold">Invitation to join <span
                            class="text-indigo-500">{{ $space->name }}</span></h1>
                @error('space')
                <h2 class="px-4 py-2 my-2 text-xl font-light text-red-500 bg-red-200 border border-red-400 rounded">{{ $message }}</h2>
                @enderror
                <div class="flex flex-row items-start justify-between w-full mt-3">
                    <a href="{{ route('spaces.index') }}" class="primary-button">Go to spaces</a>
                    <button type="submit" class="primary-button">Join</button>
                </div>
            </div>
        </div>
    </form>
@endsection
