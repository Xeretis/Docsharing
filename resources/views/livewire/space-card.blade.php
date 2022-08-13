<div class="flex p-2 my-2 bg-gray-100 rounded" x-data="{ open: false }" x-init="$watch('open', (value) => {
    const body = document.body;

    if (!value) {
        body.classList.remove('overflow-hidden')
    } else {
        body.classList.add('overflow-hidden')
    }
})">
    <div class="flex-1">
        <p class="text-lg">{{ $space->name }}
            @can('invite', $space)
                @if($space->joinable_with_hash)
                    <span class="text-gray-400"> (Code: {{ $space->hash }})</span>
                @else
                    <span class="text-gray-400"> (Invite only)</span>
                @endif
            @endcan
        </p>
        <p class="text-gray-500">{{ $space->description }}</p>
    </div>
    @can('invite', $space)
        <button x-on:click="open = true">
            <x-tabler-icon icon="share" strokeWidth="1.5" class="self-center h-6 ml-2"/>
        </button>
    @endcan
    @can('update', $space)
        <a href="{{ route('spaces.edit', ['space' => $space->hash]) }}" class="self-center">
            <x-tabler-icon icon="edit" strokeWidth="1.5" class="h-6 ml-2"/>
        </a>
    @endcan
    @can('view', $space)
        <a href="{{ route('spaces.view', ['space' => $space->hash]) }}" class="self-center">
            <x-tabler-icon icon="arrow-right" strokeWidth="1.5" class="self-center h-6 m-2"/>
        </a>
    @endcan

    <!-- invite modal -->
    <div class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50" x-cloak
         x-show="open">
        <div x-ref="generateModal" x-show="open" x-cloak x-on:click.away="open = false"
             class="flex flex-col w-3/4 p-6 bg-white rounded md:w-2/3 lg:w-2/4 xl:w-1/4">

            @if($space->joinable_with_hash)
                <h1 class="py-2 text-xl font-medium text-center">Pernament invite</h1>
                <p class="block py-2 overflow-hidden text-gray-600 text-md text-ellipsis whitespace-nowrap">Invite link:
                    <a href="{{ route('spaces.join-invite', ['space' => $this->space->hash], false) }}"
                       class="anchor">{{ route('spaces.join-invite', ['space' => $this->space->hash]) }}</a></p>
                <button class="self-end primary-button" x-on:click="open = false">Close</button>
            @else
                <h1 class="py-2 text-xl font-medium text-center">Generate invite</h1>
                <p class="block py-2 overflow-hidden text-gray-600 text-md text-ellipsis whitespace-nowrap">Invite link:
                    <a href="{{ $url }}" class="anchor">{{ $url }}</a></p>
                @if($expire)
                    <div class="flex py-2">
                        <div class="flex-1 mr-2">
                            <label for="amount" class="self-start mt-3">Valid for</label>
                            <input type="text" wire:model.lazy="amount" id="amount"
                                   class="w-full input @error('amount') border-red-500 @enderror">
                            @error('amount')
                            <p class="self-start text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex-1">
                            <label for="unit" class="self-start mt-3">Unit</label>
                            <select wire:model="unit" id="unit"
                                    class="w-full input @error('unit') border-red-500 @enderror">
                                <option value="months">Month(s)</option>
                                <option value="days">Day(s)</option>
                                <option value="hours">Hour(s)</option>
                                <option value="minutes">Minute(s)</option>
                                <option value="seconds">Second(s)</option>
                            </select>
                            @error('unit')
                            <p class="self-start text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-between w-full">
                    <div>
                        <label for="expire" class="mr-2">Expires</label>
                        <input type="checkbox" wire:model="expire" id="expire" class="checkbox">
                    </div>
                    <div>
                        <button class="primary-button" wire:click.prefetch="generate">Generate</button>
                        <button class="primary-button" x-on:click="open = false">Close</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
