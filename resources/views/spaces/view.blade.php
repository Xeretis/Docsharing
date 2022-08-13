@extends('layouts.app')

@section('content')
    <div class="p-4">
        <div class="flex justify-between">
            <h1 class="text-2xl font-semibold items-center pb-2">{{ $space->name }}</h1>
            <div>
                @can('update', $space)
                    <a class="primary-button">Manage members</a>
                @endcan
                @can('addPost', $space)
                    <a href="{{ route('posts.create', ["space" => $space]) }}" class="primary-button">New post</a>
                @endcan
                <a href="{{ route('spaces.index') }}" class="primary-button">Back</a>
            </div>
        </div>
        <p class="text-gray-500 pb-2">{{ $space->description }}</p>
        <div class="pt-2">
            <h1 class="text-xl font-medium">Posts</h1>
            @foreach($space->posts as $post)
                <livewire:post-card :post="$post" :space="$space"/>
            @endforeach
        </div>
    </div>
@endsection

