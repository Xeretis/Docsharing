@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full h-screen">
        <div class="flex flex-col items-center w-3/4 md:w-1/2 lg:w-1/4">
            <h1 class="text-2xl font-semibold">Create post</h1>
            <livewire:post-form :space="$space"/>
        </div>
    </div>
@endsection
