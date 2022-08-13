@extends('layouts.app')

@section('content')
    <x-navbar />

    <div class="px-4">
        <div class="flex items-center justify-between">
            <h1 class="py-2 text-xl font-medium">Own spaces</h1>
            @can('create', App\Models\Space::class)
                <a href="{{ route('spaces.create') }}" class="anchor">
                    Create space
                </a>
            @endcan
        </div>
        @if ($ownedSpaces->isNotEmpty())
            @foreach ($ownedSpaces as $space)
                <livewire:space-card :space="$space">
            @endforeach
        @endif

        <div class="flex items-center justify-between">
            <h1 class="py-2 text-xl font-medium">Joined spaces</h1>
            <a href="{{ route('spaces.join') }}" class="anchor">
                Join space
            </a>
        </div>
        @if ($joinedSpaces->isNotEmpty())
            @foreach ($joinedSpaces as $space)
                <livewire:space-card :space="$space">
            @endforeach
        @endif
</div>
@endsection
